<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Article;
use Image;
use Session;
use Redirect;
use App\Group;
use App\Http\Requests;

class ArticlesController extends Controller
{

    public function index()
    {
        $articles = Article::orderBy('title')-> paginate(12);
        $links = str_replace('/?', '?', $articles->render());

        return view('site.articles.view',
            [
                'articles' => $articles,
                'links' => $links,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all() -> sortBy('title'); //выбираем все категории
        $groups = Group::all(); //выбираем все группы
        return view('site.articles.create', 
            [
                'categories' => $categories, 
                'groups' => $groups,
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
        if($request->hasFile('preview')) {
            $img_root = 'images/articles';

            $fileName = $request->file('preview')->getClientOriginalName();
            $request->file('preview')->move($img_root, $fileName);

            $img = Image::make('images/articles/'. $fileName);
            $img->resize(300, 300);
            $img->save('images/articles/'. $fileName);

            $all = $request->all();
            $all['preview'] = "/images/articles/" . $fileName;

            Article::create($all);

        } else {
            $all = $request->all();
            $all['preview']= "none";
            Article::create($all);
        }

        /*$categories = Category::all() -> sortBy('title');*/

        Session::flash('message', 'Товар сохранен!');
        return Redirect::to('/articles');
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
