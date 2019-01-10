<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Project;
use App\Target;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TargetsController extends Controller
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
        return view('targets.create');
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
            'date' => 'required|date'
        ]);

        $profiles = Profile::select('id', 'group_id')->whereIsDeleted(0)->orderBy('group_id', 'asc')->get();
        $projects = Project::select('id', 'post_date')->whereIsArchive(0)->orderBy('id', 'asc')->get();

        $beginDate = Carbon::createFromFormat('Y-m-d', $request->get('date'));
        $endDate = Carbon::createFromTimestamp($beginDate->getTimestamp())->addDay($projects->count() - 1);
        $firstDate = Carbon::createFromTimestamp($beginDate->getTimestamp());

        foreach ($projects as $project) {
            $date = Carbon::createFromTimestamp($firstDate->getTimestamp());
            $groupId = $profiles->first()->group_id;

            foreach ($profiles as $profile) {
                if ($groupId != $profile->group_id) {
                    $groupId = $profile->group_id;

                    $date->addDay(1);

                    if ($date->greaterThan($endDate)) {
                        $date = Carbon::createFromTimestamp($beginDate->getTimestamp());
                    }
                }

                $post_date = empty($project->post_date)
                    ? Carbon::createFromTimestamp($date->getTimestamp())->addDay(1)
                    : Carbon::createFromTimestamp($date->getTimestamp())->addDay($project->post_date);

                $target = new Target();
                $target->profile_id = $profile->id;
                $target->project_id = $project->id;
                $target->register_date = $date->format('Y-m-d');
                $target->post_date = $post_date->format('Y-m-d');
                $target->save();

//                print "Group: {$groupId}\tProfile ID: {$profile->id}\tProject ID: {$project->id}\t Date: {$date->toDateTimeString()}\n";
//                $arr[$date->toDateTimeString()][$groupId][$project->id][] = $profile->id;
//                $arr[$date->toDateTimeString()][$project->id][] = $profile->id;
            }

            $firstDate->addDay(1);
        }

//        dd($arr);
        exit;
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
