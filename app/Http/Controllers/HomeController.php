<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(Auth::user()->role);

        return view('home');
    }

    public function cookie(Request $request)
    {
        $time = 259200; // 180 days

        if (empty($request->cookie($request->name))) {
            return response('Cookie is set')->cookie($request->name, 1, $time);
        }

        return response('Cookie unset')->cookie($request->name, 1, $time * -1);
    }
}
