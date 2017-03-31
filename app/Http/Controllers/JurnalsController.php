<?php

namespace App\Http\Controllers;

use App\Article;
use App\Contragent;
use App\Operation;
use App\Sklad;
use Illuminate\Http\Request;
use App\Jurnal;
use Session;
use Redirect;
use Auth;
use Cookie;

use App\Http\Requests;

class JurnalsController extends Controller
{
    public function index()
    {
        $jurnals = Jurnal::orderBy('created_at','DESC')-> paginate(12);
        $links = str_replace('/?', '?', $jurnals->render());

        return view('site.jurnals.view',
            [
                'jurnals' => $jurnals,
                'links' => $links,
            ]);
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

    //------------------------------------------------------------------
    //Покупка.
    public function purchase()
    {
        $contragents = Contragent::where('group', 'Поставщики')-> get();
        session()->put('contragents', $contragents);
        session()->put('operation', 'покупка');
        session()->put('priznak', '-1');
        session()->put('user', Auth::user()->name);  //кто user?
        session()->put('sklad', Cookie::get('sklad')); //торговая точка.

        return Redirect::to('/buy');

    }

    //Форма.
    public function buy(Request $request)
    {
        $contragents = session()->get('contragents');

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
            //массив 'sale' не существует.
            $orders = array();
        }

        return view('site.carts.buy',
            [
                'orders' => $orders,
                'contragents' => $contragents,
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



    //провести операцию.
    public function order()
    {
      if (Session::has('sale')) //Есть массив 'sale'?
        {
            $sales = session('sale'); //все выбранные записи
            if(count($sales) > 0) {
                foreach ($sales as $sale => $id) //записать в переменную все выбранные записи.
                {
                    $prod = new Jurnal();            //новая запись для таблицы 'jurnals'.
                    $art = Article::find($sale);     //товар из articles - выбран по ID
                    $kol = session('sale.' . $sale);  //из сессии берём количество - по ID
                    $prod->kol = $kol;                //добавляем количество
                    $prod->title = $art->title;       //название товара
                    $prod->contragent = Contragent::find(session('contragent'))->title; //контрагент.
                    $prod->sklad = session('sklad');        //тор.точка.
                    $prod->operation = session('operation'); //тип операции.
                    $prod->cena = $art->cena_in;            //цена
                    $prod->priznak = session('priznak');    //признак операции.
                    $prod->user = session('user');          //ползователь.

                    $prod->save();                //записать в таблицу.

                }
                Session::forget('sale'); //удалить переменную 'sale'.
               // Session::flush(); //полностью очистить сессию.
                Session::flash('message', 'Успешно!');
            }
        }

        return Redirect::to('/buy');
    }

//-------------------------------------------------------
    //Удаление записи из журнала.
    public function deljur($id)
    {
        $jurnal = Jurnal::find($id);
        $jurnal -> delete();

        Session::flash('message', 'Запись удалёна!');
        return redirect()->back();

    }

    //-------------------------------------------------------------------
    //Применить фильтр.
    public function filter(Request $request)
    {
        $contragent = $request ->input("contragent");
        $sklad = $request ->input("sklad");
        $operation = $request ->input("operation");

        $request->session()->put('filter.contragent', $contragent);
        $request->session()->put('filter.sklad', $sklad);
        $request->session()->put('filter.operation', $operation);


        if($contragent == 0){
            $sign = '<>';
            $value = 'unknows'; //Все.
        } else {
            $sign = '=';
            $value = Contragent::find($contragent)->title;
        }

        if($sklad == 0){
            $sign2 = '<>';
            $value2 = 'unknows'; //Все.
        } else {
            $sign2 = '=';
            $value2 = Sklad::find($sklad)->title;
        }

        if($operation == 0){
            $sign3 = '<>';
            $value3 = 'unknows'; //Все.
        } else {
            $sign3 = '=';
            $value3 = Operation::find($operation)->title;
        }

        $jurnals = Jurnal::where('contragent',$sign ,$value)
            -> where('sklad',$sign2 ,$value2)
            -> where('operation',$sign3 ,$value3)
            -> orderBy('created_at','DESC')-> paginate(12);

        $links = str_replace('/?', '?', $jurnals->render());

        return view('site.jurnals.view',
            [
                'jurnals' => $jurnals,
                'links' => $links,
            ]);
    }

    public function test()
    {
        
    return view('site.jurnals.test');        
        
    }


}
