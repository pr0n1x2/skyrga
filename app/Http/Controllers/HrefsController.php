<?php

namespace App\Http\Controllers;

use App\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

class HrefsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hrefs.create');
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

            while (($data = fgetcsv($handle, 2048, ";")) !== false) {
                $domainRating = $data[2];
                $url = $data[5];
                $pageTitle = $data[6];
                $linkUrl = $data[9];
                $externalLinksCount = $data[8];

                $domainId = Domain::getDomainId($url);
            }

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
        //
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
        //
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
