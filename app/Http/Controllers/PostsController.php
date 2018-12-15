<?php

namespace App\Http\Controllers;

use App\Post;
use App\Profile;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::select('id', 'name')->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create', [
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
            'name' => 'required|min:2|max:100',
            'title'  => 'required',
            'text'  => 'required',
            'anchor1'  => 'required',
            'anchor2'  => 'required',
            'anchor3'  => 'required',
            'anchor4'  => 'required'
        ]);

        $post = new Post();
        $post->fill($request->all());
        $post->save();

        $post->profiles()->sync($request->get('profiles'));

        return redirect()->route('posts.index')->with('success', 'New post has been successfully added.');
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
        $post = Post::find($id);

        return view('posts.edit', [
            'post' => $post,
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
            'name' => 'required|min:2|max:100',
            'title'  => 'required',
            'text'  => 'required',
            'anchor1'  => 'required',
            'anchor2'  => 'required',
            'anchor3'  => 'required',
            'anchor4'  => 'required'
        ]);

        $post = Post::find($id);
        $post->fill($request->all());
        $post->save();

        $post->profiles()->sync($request->get('profiles'));

        return redirect()->route('posts.index')->with('success', 'Post has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();

        return redirect()->route('posts.index')->with('success', 'Post has been deleted.');
    }
}
