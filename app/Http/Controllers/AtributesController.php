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
    public function add($id) // id-товар
    {
        $article = Article::find($id); //для заголовка
                
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
                'article' => $article,
            ]);
        }
    }

    /*------------- Добавить атрибут  -------------------*/
    public function add2($id) // id-товар
    {
        
        return view('site.atributes.create',
            [
                'id' => $id,
            ]);
    } 
    
    
    public function create($id)
    {
        //
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
        Session::flash('message', 'Атрибут сохранен!');

        return redirect()->action('AtributesController@add',
            [
                'id' => $id,
            ]);

        /*return view('site.atributes.view',
            [
                'article' => $article,
                'atributes' => $atributes,
                'links' => $links,
            ]);*/
    }
    
    /*-------- Сохранить как шаблон.  --------------*/
    public function tample($id) //в id - код товара.
    {
        //Удаление старого шаблона.
        $article = Article::find($id); //получить этот товар.
        //удалить записи по условию: код товара "-377" и текущую категорию
        $attr =  Atribute::where(['article_id' => '-377', 'category_id' => $article -> category_id ])->delete();


        //Сохранение нового шаблона.
        $attrs = Atribute::where('article_id', $id)-> get();
        foreach ($attrs as $row)
        {
            $model = new Atribute();

            $model->article_id = '-377'; //id товара - признак шаблона.
            $model->category_id = $row->category_id;
            $model->key = $row->key;
            $model->value = $row->value;
            $model->save();
        }

        Session::flash('message', 'Шаблон сохранен!');
        return redirect()->action('AtributesController@add',
            [
                'id' => $id,
            ]);
    }

    /*-----------------------------------------------------------*/
    public function load($id) //в id - код товара.
    {
        //Удалить все атрибуты.
        $article = Article::find($id); //получить этот товар.
        //удалить записи по условию: код товара и текущую категорию
        $attr =  Atribute::where(['article_id' => $id, 'category_id' => $article -> category_id ])->delete();

        //Загрузить новый шаблон.
        $attrs = Atribute::where(['article_id' => '-377', 'category_id' => $article ->category_id ])->get();

        foreach ($attrs as $row) //сохранить в БД с id товара.
        {
            $model = new Atribute();

            $model->article_id = $id; //id товара
            $model->category_id = $row->category_id;
            $model->key = $row->key;
            $model->value = $row->value;
            $model->save();
        }

        if (count($attrs)>0)
        { Session::flash('message', 'Шаблон загружен!');}
        else
        {Session::flash('message', 'Шаблон не найден!');}

        return redirect()->action('AtributesController@add',
            [
                'id' => $id,
            ]);
    }
    
    
    
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
        $atribute = Atribute::find($id);
        return view('site.atributes.edit',
            [
                'atribute' => $atribute,
                
            ]);
    }

    
    public function update(Request $request, $id) //id-атрибута.
    {
        $atribute = Atribute::find($id);
        $all = $request->all();
        $atribute -> update($all);

        $id = $atribute ->article_id; //id товара.


        Session::flash('message', 'Атрибут изменён!');
        return redirect()->action('AtributesController@add',
            [
                'id' => $id,
            ]);
    }
    
    public function destroy($id)
    {
        $atribute = Atribute::find($id);
        $atribute -> delete();

        Session::flash('message', 'Атрибут удалён!');
        return redirect()->back();
    }
}
