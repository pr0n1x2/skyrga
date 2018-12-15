<?php

namespace App\Http\Controllers;

use App\Image;
use App\Profile;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::all();

        return view('images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('images.create', [
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
            'url'  => 'required|url',
            'alt'  => 'required|max:3000'
        ]);

        $image = new Image();
        $image->fill($request->all());
        $image->save();

        $image->profiles()->sync($request->get('profiles'));

        return redirect()->route('images.index')->with('success', 'New image has been successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = Image::find($id);

        return response()->json([
            'name'  => $image->name,
            'url'   => $image->url,
            'alt'   => $image->getAlternativeText()
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
        $image = Image::find($id);

        return view('images.edit', [
            'image' => $image,
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
            'url'  => 'required|url',
            'alt'  => 'required|max:3000'
        ]);

        $image = Image::find($id);
        $image->fill($request->all());
        $image->save();

        $image->profiles()->sync($request->get('profiles'));

        return redirect()->route('images.index')->with('success', 'Image has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Image::find($id)->delete();

        return redirect()->route('images.index')->with('success', 'Image has been deleted.');
    }
}
