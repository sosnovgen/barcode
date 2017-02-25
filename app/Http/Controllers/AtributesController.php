<?php

namespace App\Http\Controllers;

use App\Atribute;
use Illuminate\Http\Request;
use App\Category;
use App\Article;
use Image;
use Session;
use Redirect;
use App\Group;


use App\Http\Requests;

class AtributesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $atributes = Atribute::orderBy('key')-> paginate(12);
        $links = str_replace('/?', '?', $atributes->render());

        return view('site.atributes.view',
            [
                'atributes' => $atributes,
                'links' => $links,
            ]);
    }

    /*------------- Добавить атрибут  -------------------*/
    public function add($id,$id2) // id-товар, id2-категория.
    {
        $article = Article::where('id', $id)->first(); //для заголовка
                
        $atributes = Atribute::where('article_id', $id)-> paginate(12);
        $links = str_replace('/?', '?', $atributes->render());

        $count = $atributes ->count(); //число строк

        if (!empty($count)){
            return view('site.atributes.view',
            [
                'article' => $article,
                'atributes' => $atributes,
                'links' => $links,
            ]);

        } else {

        return view('site.atributes.create',
            [
                'id' => $id,
                'id2' => $id2,
                'article' => $article,
            ]);
        }
    }

    /*------------- Добавить атрибут  -------------------*/
    public function add2($id,$id2) // id-товар, id2-категория.
    {
        $article = Article::where('id', $id)->first(); //для заголовка
        
        return view('site.atributes.create',
            [
                'id' => $id,
                'id2' => $id2,
                'article' => $article,
            ]);
    } 

    
    
    public function create($id)
    {
        return view('site.atributes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all = $request->all();
        Atribute::create($all);
        $id = $all['article_id']; //id товара.
        $article = Article::where('id', $id)->first();

        $atributes = Atribute::where('article_id', $id)->paginate(12);
        $links = str_replace('/?', '?', $atributes->render());

        Session::flash('message', 'Атрибут сохранен!');
        return view('site.atributes.view',
            [
                'article' => $article,
                'atributes' => $atributes,
                'links' => $links,
            ]);
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
