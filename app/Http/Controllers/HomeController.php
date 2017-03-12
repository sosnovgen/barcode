<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Gate;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('create')){
            return redirect('/register');
        }
        /*return view('home');*/
        return view('site.front.index');
    }
}
