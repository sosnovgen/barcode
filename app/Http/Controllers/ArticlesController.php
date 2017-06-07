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

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('title')-> paginate(12);
        $links = str_replace('/?', '?', $articles->render());

        $categories = Category::all()-> sortBy('title');
        $sort = 0; //сортировка по категории отключена

        return view('site.articles.view',
            [
                'articles' => $articles,
                'categories' => $categories,
                'sort' => $sort,
                'links' => $links,
            ]);
    }

    public function indexid($id)
    {
        $articles = Article::where('category_id','=',$id) -> orderBy('title') -> paginate(8);
        $links = str_replace('/?', '?', $articles->render());
        $categories = Category::all()-> sortBy('title');;
        $groups = Group::all();
        $sort = 1;

        return view('site.articles.view',
            [
                'articles' => $articles,
                'categories' => $categories,
                'sort' => $sort,
                'links' => $links,
            ]);
    }


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

 
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $article = Article::find($id); //выбираем овар для редактирования
        $categories = Category::all() -> sortBy('title'); // выбираем все категории
        $groups = Group::all(); //выбираем все группы
        return view('site.articles.edit',
            [
                'article' => $article, 
                'categories' => $categories, 
                'groups' => $groups]);
    }


    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        if ($request->hasFile('preview')) {
            $img_root = 'images/articles';

            $fileName = $request->file('preview')->getClientOriginalName();
            $request->file('preview')->move($img_root, $fileName);

            $img = Image::make('images/articles/' . $fileName);
            $img->resize(300, 300);
            $img->save('images/articles/' . $fileName);

            $all = $request->all();
            $all['preview'] = "/images/articles/" . $fileName;

            $article->update($all);

        } else {
            $all = $request->all();
            //  $all['preview']= "placehold.it";
            $article->update($all);
        }
        Session::flash('message', 'Товар изменён!');
        return Redirect::to('/articles');
    }


    public function destroy($id)
    {
        $article = Article::find($id);

        $fileName = ($article -> preview);
        $fileName = mb_substr($fileName,1);
        if (is_file($fileName))
        {
            unlink($fileName);
        }
        $article->delete();

        //удалить все атрибуты товара id.
        $attr =  Atribute::where(['article_id' => $id])->delete();

        Session::flash('message', 'Товар удалён!');
        return Redirect::to('/articles');
    }

    public function barcode($id)
    {
        $article = Article::find($id);
        
    }

    public function find(Request $request)
    {
        $name = $request->input('q22');
        $articles = Article::Where('title', 'like', $name . '%')-> orderBy('title') -> paginate(8);
        $links = str_replace('/?', '?', $articles->render());

        $categories = Category::all()-> sortBy('title');
        $sort = 0; //сортировка по категории отключена

        return view('site.articles.view',
            [
                'articles' => $articles,
                'categories' => $categories,
                'sort' => $sort,
                'links' => $links,
                
            ]);

    }

}
