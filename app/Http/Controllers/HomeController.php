<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Sklad;
use Gate;
use Cookie;
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

        //получить имя склада.
        $sklad = Cookie::get('sklad');
        if (is_null($sklad))
            {
                $sklads = Sklad::all();
               
                return view('site.front.cookie', 
                    [
                        'sklads' => $sklads,  
                    ]);
            }
        /*return view('home');*/
        return view('site.front.index', ['sklad' => $sklad]);
    }

    /*----------------- Выбрать склад куки.  -------------------*/
    public function sklad(Request $request){

        $sklad = $request ->input("sklad");
        /*Cookie::queue('sklad', $sklad, '60');*/ //в очередь (после следующего запроса).
        $cookie = Cookie::forever('sklad', $sklad);

        return  redirect('/')->cookie($cookie);
    }

    /*----------------- Удалить склад куки.  -------------------*/
    public function delsklad(){

        Cookie::queue(Cookie::forget('sklad'));
        return  redirect('/');

    }

}
