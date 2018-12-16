<?php

namespace App\Http\Controllers;

use App\Project;
use Carbon\Carbon;
use Chumper\Zipper\Zipper;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    private $rules = [
        'name' => 'required|min:2|max:70',
        'domain' => 'required|url|max:70',
        'register_page' => 'required|url|max:191',
        'login_page' => 'required|url|max:191',
        'post_date' => 'nullable|numeric|digits_between:1,10',
        'paragraph_link' => 'nullable|numeric|digits_between:1,4'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::select('id', 'name', 'is_archive')->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules);

        $project = new Project();
        $project->fill($request->all());
        $project->setCheckboxes($request);
        $project->save();

        return redirect()->route('projects.index')->with('success', 'New project has been successfully added.');
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

        return view('projects.edit', compact('project'));
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
        $this->validate($request, $this->rules);

        $project = Project::find($id);
        $project->fill($request->all());
        $project->setCheckboxes($request);
        $project->is_archive = $request->is_archive ? 0 : 1;
        $project->save();

        return redirect()->route('projects.index')->with('success', 'Project has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->is_archive = 1;
        $project->save();

        return redirect()->route('projects.index')->with('success', 'The project has been sent to the archive.');
    }

    /**
     * Move to archive all resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function archive()
    {
        Project::where('is_archive', '=', 0)->update(['is_archive' => 1]);

        return redirect()->route('projects.index')->with('success', 'All projects were archived.');
    }

    /**
     * Download file from specified resource.
     *
     * @param  int  $id
     * @param  string  $file
     * @return \Illuminate\Http\Response
     */
    public function download($id, $file)
    {
        $project = Project::find($id);
        $pathToFile = public_path() . Project::PATH_TO_UBOT_FILES;

        switch ($file) {
            case 'register':
                $pathToFile .= $project->login_file;
                break;
            case 'singin':
                $pathToFile .= $project->singin_file;
                break;
            case 'post':
                $pathToFile .= $project->post_file;
                break;
        }

        return response()->download($pathToFile);
    }

    /**
     * Download all active files in zip archive.
     *
     * @return \Illuminate\Http\Response
     */
    public function zip()
    {
        $date = Carbon::now();
        $filename = 'Ubot-Scripts-' . $date->toDateString() . '.zip';

        $zipper = new Zipper();
        $zipper->make(public_path($filename));

        $projects = Project::select('login_file', 'singin_file', 'post_file')->where('is_archive', '=', 0)->get();

        foreach ($projects as $project) {
            if (!empty($project->login_file)) {
                $zipper->folder('register')
                    ->add(public_path() . Project::PATH_TO_UBOT_FILES . $project->login_file);
            }

            if (!empty($project->singin_file)) {
                $zipper->folder('sing_in')
                    ->add(public_path() . Project::PATH_TO_UBOT_FILES . $project->singin_file);
            }

            if (!empty($project->post_file)) {
                $zipper->folder('post')
                    ->add(public_path() . Project::PATH_TO_UBOT_FILES . $project->post_file);
            }
        }

        $zipper->close();

        return response()->download($filename)->deleteFileAfterSend();
    }
}
