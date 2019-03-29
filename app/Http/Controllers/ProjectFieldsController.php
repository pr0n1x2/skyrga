<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Project;
use App\ProjectField;
use Illuminate\Http\Request;

class ProjectFieldsController extends Controller
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
    public function create($id)
    {
        $project = Project::find($id);
        $fields = ProjectField::select('name')
            ->whereProjectId($id)
            ->distinct()
            ->get()
            ->pluck('name')
            ->map(function ($item) {
                return (int)substr($item, 5);
            })
            ->toArray();

        return view('fields.create', compact('project', 'fields'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project_id = (int)$request->get('project_id');
        $fields = $request->get('type');
        $profiles = Profile::getProfilesIds();

        for ($i = 0; $i < count($profiles); $i++) {
            $inserts = [];

            foreach ($fields as $key => $value) {
                if ($value) {
                    $inserts[] = [
                        'project_id' => $project_id,
                        'profile_id' => $profiles[$i],
                        'type' => $value,
                        'name' => 'field' . $key
                    ];
                }
            }

            if (count($inserts)) {
                ProjectField::insert($inserts);
            }
        }

        return redirect()->route('fields.edit', $project_id);
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
        $project = Project::find($id);
        $form = [];
        $profiles = Profile::select('id', 'name')->get()->pluck('name', 'id')->toArray();
        $fields = ProjectField::whereProjectId($id)
            ->orderBy('profile_id', 'asc')
            ->orderBy('name', 'asc')
            ->get()
            ->toArray();

        for ($i = 0; $i < count($fields); $i++) {
            $form[$fields[$i]['profile_id']][] = [
                'id' => $fields[$i]['id'],
                'type' => $fields[$i]['type'],
                'name' => $fields[$i]['name'],
                'value' => $fields[$i]['value']
            ];
        }

        return view('fields.edit', compact('project', 'form', 'profiles'));
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
        $fields = $request->get('field');

        foreach ($fields as $field_id => $field_value) {
            ProjectField::where('id', $field_id)->update(['value' => $field_value]);
        }

        return redirect()->route('projects.edit', $id)->with('success', 'Fields have been updated successfully.');
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
