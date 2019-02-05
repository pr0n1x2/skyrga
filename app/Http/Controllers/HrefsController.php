<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Href;
use App\HrefsStatus;
use App\HrefsType;
use App\Site;
use App\SitesCity;
use App\SitesType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class HrefsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $href = null;

        if (is_numeric($id)) {
            $href = Href::find($id);
        } else {
            $link = Href::select('hrefs.id', 'domains.rating')
                ->join('domains', 'hrefs.domain_id', '=', 'domains.id')
                ->where('hrefs.is_analized', 1)
                ->where('hrefs.hrefs_status_id', 1)
                ->orderBy('domains.rating', 'desc')
                ->orderBy('hrefs.id', 'asc')
                ->limit(1)
                ->get()
                ->pluck('id')
                ->toArray();

            if ($link) {
                $href = Href::find($link[0]);
            }
        }

        $statuses = HrefsStatus::where('id', '>', 3)->get();

        return view('hrefs.index', compact('href', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hrefs.create', [
            'cities' => SitesCity::orderBy('name', 'asc')->get()->pluck('name', 'id'),
            'types' => SitesType::all()->pluck('name', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'site' => 'required|url|max:191',
            'csv_file' => ['required', 'file', function ($attribute, $file, $fail) {
                if (strtolower($file->getClientOriginalExtension()) != 'csv') {
                    $fail($attribute . ' must be csv file.');
                }
            }]
        ]);

        $colsCount = 22;

        if (($handle = fopen($request->csv_file->path(), "r")) !== false) {
            $data = fgetcsv($handle, 2048, ";");

            if (is_array($data) && count($data) != $colsCount) {
                return redirect()->back()
                    ->with('errors', new MessageBag([
                        'The number of columns in the CSV file does not match the stated number.'
                    ]));
            }

            $siteId = Site::getSiteId(
                $request->get('site'),
                $request->get('sites_city_id'),
                $request->get('sites_type_id')
            );

            while (($data = fgetcsv($handle, 2048, ";")) !== false) {
                $domainRating = (int)$data[2];

                if ($domainRating) {
                    $url = $data[5];
                    $pageTitle = $data[6];
                    $linkUrl = $data[9];
                    $externalLinksCount = $data[8];
                    $linkAnchor = $data[11];
                    $type = $data[13];

                    $typeId = HrefsType::getTypeId($type);
                    $domainId = Domain::getDomainId($url, $domainRating);

                    $urlInfo = parse_url($url);
                    $urlStr = $urlInfo['path'];

                    if (isset($urlInfo['query'])) {
                        $urlStr .= '?' . $urlInfo['query'];
                    }

                    if (strlen($urlStr) > 191) {
                        $urlStr = substr($urlStr, 0, 191);
                    }

                    if (strlen($pageTitle) > 191) {
                        $pageTitle = substr($pageTitle, 0, 191);
                    }

                    if (strlen($linkUrl) > 191) {
                        $linkUrl = substr($linkUrl, 0, 191);
                    }

                    if (strlen($linkAnchor) > 191) {
                        $linkAnchor = substr($linkAnchor, 0, 191);
                    }

                    $isUseDomain = Href::isUseDomain($domainId);

                    $href = new Href();
                    $href->domain_id = $domainId;
                    $href->site_id = $siteId;
                    $href->url = $urlStr;
                    $href->page_title = $pageTitle;
                    $href->link_url = $linkUrl;
                    $href->link_anchor = $linkAnchor;
                    $href->external_links_count = $externalLinksCount;
                    $href->hrefs_status_id = 1;
                    $href->hrefs_type_id = $typeId;
                    $href->is_analized = !$isUseDomain ? true : false;
                    $href->save();
                }
            }

            Domain::updateDomainRating();

            fclose($handle);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'hrefs_status_id' => 'required',
        ]);

        $href = Href::find($id);
        $href->hrefs_status_id = $request->get('hrefs_status_id');
        $href->comment = $request->get('comment');
        $href->analized_date = Carbon::now()->format('Y-m-d');
        $href->user_id = Auth::user()->id;
        $href->save();

        return redirect()->route('hrefs.index')
            ->with('success', 'The link was successfully processed and saved with the new status.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
