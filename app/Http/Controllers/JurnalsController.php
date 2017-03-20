<?php

namespace App\Http\Controllers;

use App\Article;
use App\Contragent;
use Illuminate\Http\Request;
use App\Jurnal;
use Session;
use Redirect;

use App\Http\Requests;

class JurnalsController extends Controller
{
    public function index()
    {
        $jurnals = Jurnal::orderBy('created_at')-> paginate(12);
        $links = str_replace('/?', '?', $jurnals->render());

        return view('site.jurnals.view',
            [
                'jurnals' => $jurnals,
                'links' => $links,
            ]);
    }

    //-------------------------------------------------------------------
    //Добавление товара в сессию.
    public function session(Request $request)
    {
        $bar = $request ->input("bar"); //штрих-код.
        if($bar == '')
        {
            Session::flash('message', 'Штрих-код не введён!!');
            return redirect()-> back();
        }

        $article = Article::where('barcode', $bar)->first(); //найти товар по ш-коду.
        if(!$article)
        {
            Session::flash('message', 'Товар не найден!');
            return redirect()-> back();
        }
        //$request->session()->flush(); //очистить сессию.

        $contragent = $request ->input("contragent"); //контрагент. 
        $request->session()->put('contragent', $contragent);

       $id = $article->id; //id-товара.
        if ($request->session()->has('sale')) //Есть массив 'sale'?
        {
           if (!$request->session() -> has('sale.'.$id))//если не был выбран ранее
                { $request->session()->put('sale.'.$id, 1);} //добавить товар в массив (индекс товара, кол.=1)
           else {
               //товар выбран повторно.
               $value = $request->session()->get('sale.' . $id); //взять ранее выбраное кол. товара
               $value = $value + 1; //увеличить на 1.
               $request->session()->put('sale.' . $id, $value);//записать новое кол. товвара.
           }
        }
        else {
                $request->session()->put('sale.'.$id, 1);//Добавить 1-й товар в массив (индекс товара, кол.=1)}
        }
        return Redirect::to('/buy');
    }


    //-------------------------------------------------------
    //Изменить кол. товара в корзине.
    public function count(Request $request, $id,$kol)

    {   //$id - индекс выбранного товара, $kol - количество.
        $request->session()->put('sale.'.$id, $kol);

        /*return Redirect::to('/buy');*/
    }



    //-------------------------------------------------------
    //Удаление товара из корзины
    public function del(Request $request, $id)
    {
        if ($request->session()->has('sale')) //Есть массив 'sale'?
        {
            if ($request->session() -> has('sale.'.$id))//Проверить: был выбран товар с индексом id?
            { $request->session()-> forget('sale.'.$id);}
        }
        return Redirect::to('/buy');

    }
    
    //Форма покупки.
    public function buy(Request $request)
    {
        $contragents = Contragent::where('group', 'Поставщики')-> get();
        if ($request->session()->has('sale')) //Есть массив 'sale'?
        {
          $sales = session('sale'); //Все выбранные записи
          if(count($sales) > 0) {
            foreach ($sales as $sale => $id) //Записать в переменную все выбранные записи.
               {
                   $orders[] = Article::find($sale);
               }
          }
          //если массив 'sale' существует, но пустой
          else {$orders = array();}
        }
        else {
            $orders = array();
        }

        return view('site.carts.buy',
            [
                'orders' => $orders,
                'contragents' => $contragents,
            ]);
    }

    //добавление покупки
    public function store_buy($bar)
    {
        
        
        
    }
    
    
    
}
