<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create', ['roles' => User::roles()]);
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
            'firstname' => 'required|min:2|max:40',
            'lastname'  => 'required|min:2|max:40',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6|max:' . User::MAX_PASSWORD_LENGTH,
            'photo'     => 'nullable|image'
        ]);

        $user = new User();
        $user->fill($request->all());
        $user->role = $request->role;
        $user->is_active = !$request->is_active ? 0 : 1;
        $user->save();

        return redirect()->route('users.index')->with('success', 'New user has been successfully added.');
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
        $user = User::find($id);
        $roles = User::roles();

        return view('users.edit', compact('user', 'roles'));
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
        $user = User::find($id);

        $this->validate($request, [
            'firstname' => 'required|min:2|max:40',
            'lastname'  => 'required|min:2|max:40',
            'email'     => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password'  => 'nullable|min:6|max:' . User::MAX_PASSWORD_LENGTH,
            'photo'     => 'nullable|image'
        ]);

        $user->fill($request->all());
        $user->role = $request->role;
        $user->is_active = !$request->is_active ? 0 : 1;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User has been updated successfully.');
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

    /**
     * Show the form for editing the auth specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user = Auth::user();

        return view('users.profile', compact('user'));
    }

    /**
     * Update the auth resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'firstname' => 'required|min:2|max:40',
            'lastname'  => 'required|min:2|max:40',
            'email'     => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'photo'     => 'nullable|image'
        ]);

        $user->fill($request->all());
        $user->save();

        return redirect()->back()->with('success', 'Your profile has been updated successfully.');
    }

    public function password()
    {
        return view('users.password');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'confirmed|min:6|max:25',
        ]);

        $user = Auth::user();
        $user->fill($request->all());
        $user->save();

        return redirect()->back()->with('success', 'Your password has been updated successfully.');
    }
}
