<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Video;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::all();

        return view('videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('videos.create', [
            'profiles' => Profile::pluck('name', 'id')->all(),
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
            'name' => 'required|min:3|max:100',
            'url'  => 'required|max:191'
        ]);

        $video = new Video();
        $video->fill($request->all());
        $video->save();

        $video->profiles()->sync($request->get('profiles'));

        return redirect()->route('videos.index')->with('success', 'New video has been successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $video = Video::find($id);

        return response()->json([
            'name'  => $video->name,
            'url'   => $video->url
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::find($id);

        return view('videos.edit', [
            'video' => $video,
            'profiles' => Profile::pluck('name', 'id')->all()
        ]);
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
            'name' => 'required|min:3|max:100',
            'url'  => 'required|max:191'
        ]);

        $video = Video::find($id);
        $video->fill($request->all());
        $video->save();

        $video->profiles()->sync($request->get('profiles'));

        return redirect()->route('videos.index')->with('success', 'Video has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Video::find($id)->delete();

        return redirect()->route('videos.index')->with('success', 'Video has been deleted.');
    }
}
