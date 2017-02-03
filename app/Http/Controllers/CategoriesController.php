<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;
use Redirect;
use Image;
use App\Http\Requests;

class CategoriesController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('title')-> paginate(12);
        $links = str_replace('/?', '?', $categories->render());

        return view('site.categories.view',
            [
                'categories' => $categories,
                'links' => $links,
            ]);
    }


    public function create()
    {
        $categories = Category::all() -> sortBy('title');
        return view('site.categories.create', ['categories' => $categories,]);
    }


    public function store(Request $request)
    {
        if($request->hasFile('preview')) {
            $img_root = 'images/categories';

            $fileName = $request->file('preview')->getClientOriginalName();
            $request->file('preview')->move($img_root, $fileName);

            $img = Image::make('images/categories/'. $fileName);
            $img->resize(300, 300);
            $img->save('images/categories/'. $fileName);

            $all = $request->all();
            $all['preview'] = "/images/categories/" . $fileName;

            Category::create($all);

        } else {
            $all = $request->all();
            $all['preview']= "none";
            Category::create($all);
        }

        $categories = Category::orderBy('title')-> paginate(12);
        $links = str_replace('/?', '?', $categories->render());

        Session::flash('message', 'Категория сохранена!');
        return view('site.categories.view',
            [
                'categories' => $categories,
                'links' => $links,
            ]);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $categories = Category::all() -> sortBy('title');
        $category = Category::find($id);
        return view('site.categories.edit',
            [
              'category'=>$category,
            'categories'=>$categories,
            ]);
    }


    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if ($request->hasFile('preview')) {
            $img_root = 'images/categories';

            $fileName = $request->file('preview')->getClientOriginalName();
            $request->file('preview')->move($img_root, $fileName);

            $img = Image::make('images/categories/'. $fileName);
            $img->resize(300, 300);
            $img->save('images/categories/'. $fileName);

            $all = $request->all();
            $all['preview'] = "/images/categories/" . $fileName;

            $category->update($all);

        } else {
            $all = $request->all();
            //  $all['preview']= "none";
            $category->update($all);
        }

        $categories = Category::orderBy('title')-> paginate(12);
        $links = str_replace('/?', '?', $categories->render());

        Session::flash('message', 'Категория изменена!');
        return view('site.categories.view',
            [
                'categories' => $categories,
                'links' => $links,
            ]);


    }


    public function destroy($id)
    {
        $category=Category::find($id);

        $fileName = ($category -> preview);
        $fileName = mb_substr($fileName,1);
        if (is_file($fileName))
        {
            unlink($fileName);
        }

        $category->delete();

        Session::flash('message', 'Категория удалена!');
        return Redirect::to('/categories');
    }

    public function delete($id)
    {
        //
    }
    
    /*-----------------------------------------------------------*/
    public function treecats()
    {
        //Выбираем данные из БД
        $result = Category::all() -> sortBy('title');
        
        if  (count($result) > 0){

            $cats = array(); //создать новый     массив
            //заполнить:
            foreach($result as $cat) {
                $cats_ID[$cat['id']][] = $cat;
                $cats[$cat['parent_id']][$cat['id']] =  $cat;
            }
        }

        return view('site.categories.treecats',
            [
                'cats' => $cats,
                'result' => $result,
            ]);
        
    }    
    
    
    
    
}
