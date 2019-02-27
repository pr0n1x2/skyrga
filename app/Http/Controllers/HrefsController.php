<?php

namespace App\Http\Controllers;

use App\Domain;
use App\Href;
use App\HrefsStatus;
use App\HrefsType;
use App\Site;
use App\SitesCity;
use App\SitesType;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

class HrefsController extends Controller
{
    const PAGINATE_COUNT = 20;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $href = null;
        $subDomains = null;
        $statuses = null;
        $pagesFromDomain = null;

        if (is_numeric($id)) {
            $href = Href::find($id);
        } else {
            $user = User::find(Auth::user()->id);

            if ($user->last_href_id) {
                $hrefId = $user->last_href_id;
            } else {
                $hrefId = Href::getNextHref();
            }

            $href = Href::with(['domain', 'site', 'type'])->whereId($hrefId)->first();
        }

        if ($href) {
            if ($href->hrefs_status_id == 4) {
                return redirect()->route('hrefs.index');
            }

            if ($href->domain->root_domain_id) {
                $subDomainsIds = $href->domain->rootDomain->subDomains->filter(function ($value) use ($href) {
                    return $value->id != $href->domain->id;
                })->pluck('id')->toArray();

                if ($subDomainsIds) {
                    $subDomains = Href::with(['domain' => function ($query) {
                        $query->with('scheme');
                    }, 'site'])->whereIn('domain_id', $subDomainsIds)
                        ->orderBy('id')
                        ->get();
                }
            }

            $pagesFromDomain = Href::with(['domain' => function ($query) {
                $query->with('scheme');
            }, 'site'])->where('domain_id', $href->domain_id)
                ->where('id', '<>', $href->id)
                ->orderBy('id', 'asc')
                ->get();

            if (!$pagesFromDomain->count()) {
                $pagesFromDomain = null;
            }

            $statuses = HrefsStatus::where('id', '>', 5)->get();
        }

        return view('hrefs.index', compact('href', 'statuses', 'subDomains', 'pagesFromDomain'));
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
            $data = fgetcsv($handle, 2048, ",");

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

            $successedDomains = 0;
            $failedDomains = 0;

            while (($data = fgetcsv($handle, 2048, ",")) !== false) {
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

                    if (!Href::isUseDomain($domainId)) {
                        $isUseDomain = true;
                        $successedDomains++;
                    } else {
                        $isUseDomain = false;
                        $failedDomains++;
                    }

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
                    $href->is_analized = $isUseDomain;

                    try {
                        $href->save();
                    } catch (\Exception $e) {
                        continue;
                    }
                }
            }

            Domain::updateDomainRating();

            fclose($handle);
        }

        return redirect()->route('hrefs.index')
            ->with(
                'success',
                "The data was successfully loaded into the database. Added {$successedDomains} new domains. " .
                "Found {$failedDomains} domains."
            );
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
        $href = Href::find($id);

        return view('hrefs.edit', compact('href'));
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
        $href->pending_comment = $request->get('pending_comment');

        if (!$href->analized_date) {
            $href->analized_date = Carbon::now()->format('Y-m-d');
        }

        if ($href->hrefs_status_id == 3) {
            if (!$href->user_id) {
                $href->user_id = Auth::user()->id;
            }

            if (!$href->pending_date) {
                $href->pending_date = Carbon::now()->format('Y-m-d H:i:s');
            }
        } else {
            $href->user_id = Auth::user()->id;
        }

        $href->save();

        if ($request->has('action')) {
            return redirect()->route('hrefs.pending')
                ->with('success', 'Domain has been updated successfully.');
        }

        $user = User::find(Auth::user()->id);
        $user->last_href_id = Href::getNextHref();
        $user->save();

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
        $href = Href::find($id);
        $href->hrefs_status_id = 1;
        $href->analized_date = null;
        $href->user_id = null;
        $href->comment = null;
        $href->pending_date = null;
        $href->pending_comment = null;
        $href->save();

        return redirect()->back()->with('success', 'The domain was successfully removed.');
    }

    public function successful(Request $request)
    {
        $domain = null;
        $date = null;

        $query = Href::select(['hrefs.id', 'hrefs.domain_id', 'hrefs.analized_date', 'hrefs.user_id'])
            ->join('domains', 'hrefs.domain_id', '=', 'domains.id')
            ->with(['domain' => function ($query) {
                $query->with('scheme');
            }, 'user'])
            ->where([['hrefs.is_analized', 1], ['hrefs.hrefs_status_id', 2]])
            ->orderBy('hrefs.analized_date', 'desc')
            ->orderBy('hrefs.id', 'desc');

        if ($request->query('search')) {
            $domain = $request->query('domain');
            $date = $request->query('date');

            if ($domain) {
                $query->where('domains.domain', 'like', '%' . $domain . '%');
            }

            if ($date) {
                $query->where('hrefs.analized_date', $date);
            }
        }

        $hrefs = $query->paginate(self::PAGINATE_COUNT);
        $hrefs->appends($request->only(['domain', 'date', 'search']));

        return view('hrefs.successful', compact('hrefs', 'domain', 'date'));
    }

    public function failed(Request $request)
    {
        $domain = null;
        $date = null;

        $query = Href::select(['hrefs.id', 'hrefs.domain_id', 'hrefs.analized_date', 'hrefs.user_id'])
            ->join('domains', 'hrefs.domain_id', '=', 'domains.id')
            ->with(['domain' => function ($query) {
                $query->with('scheme');
            }, 'user'])
            ->where('hrefs.is_analized', 1)
            ->whereNotIn('hrefs.hrefs_status_id', [1, 2, 3, 4])
            ->orderBy('hrefs.analized_date', 'desc')
            ->orderBy('hrefs.id', 'desc');

        if ($request->query('search')) {
            $domain = $request->query('domain');
            $date = $request->query('date');

            if ($domain) {
                $query->where('domains.domain', 'like', '%' . $domain . '%');
            }

            if ($date) {
                $query->where('hrefs.analized_date', $date);
            }
        }

        $hrefs = $query->paginate(self::PAGINATE_COUNT);
        $hrefs->appends($request->only(['domain', 'date', 'search']));

        return view('hrefs.failed', compact('hrefs', 'domain', 'date'));
    }

    public function pending(Request $request)
    {
        $domain = null;
        $date = null;

        $query = Href::select(['hrefs.id', 'hrefs.domain_id', 'hrefs.pending_date'])
            ->join('domains', 'hrefs.domain_id', '=', 'domains.id')
            ->with(['domain' => function ($query) {
                $query->with('scheme');
            }])
            ->where('hrefs.is_analized', 1)
            ->where('hrefs.hrefs_status_id', 3)
            ->orderBy('hrefs.pending_date', 'desc');

        if ($request->query('search')) {
            $domain = $request->query('domain');
            $date = $request->query('date');

            if ($domain) {
                $query->where('domains.domain', 'like', '%' . $domain . '%');
            }

            if ($date) {
                $query->whereBetween('hrefs.pending_date', [$date . ' 00:00:00', $date . ' 23:59:59']);
            }
        }

        $hrefs = $query->paginate(self::PAGINATE_COUNT);
        $hrefs->appends($request->only(['domain', 'date', 'search']));

        return view('hrefs.pending', compact('hrefs', 'domain', 'date'));
    }
}
