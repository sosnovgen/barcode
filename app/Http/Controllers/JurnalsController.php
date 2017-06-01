<?php

namespace App\Http\Controllers;

use App\Article;
use App\Contragent;
use App\Detal;
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
        Session::forget('sale'); //удалить переменную 'sale' - очистить предыдущую операцию.
        $contragents = Contragent::where('group', 'Поставщики')-> get();
        session()->put('contragents', $contragents);
        session()->put('operation', 'покупка');
        session()->put('priznak', '-1');
        session()->put('user', Auth::user()->name);  //кто user?
        session()->put('sklad', Cookie::get('sklad')); //торговая точка.

        return Redirect::to('/buy');

    }

    //Продажа.
    public function sale()
    {
        Session::forget('sale'); //удалить переменную 'sale' - очистить предыдущую операцию.
        $contragents = Contragent::where('group', 'Покупатели')-> get();
        session()->put('contragents', $contragents);
        session()->put('operation', 'продажа');
        session()->put('priznak', '1');
        session()->put('user', Auth::user()->name);  //кто user?
        session()->put('sklad', Cookie::get('sklad')); //торговая точка.

        return Redirect::to('/buy');

    }

    //Выдача.
    public function delivery()
    {
        Session::forget('sale'); //удалить переменную 'sale' - очистить предыдущую операцию.
        $_sklad = Cookie::get('sklad'); //торговая точка.
        session()->put('sklad', $_sklad);
        $contragents = Sklad::where('title', '<>', $_sklad)-> get();
        session()->put('contragents', $contragents);
        session()->put('operation', 'выдача');
        session()->put('priznak', '1');
        session()->put('user', Auth::user()->name);  //кто user?

        return Redirect::to('/buy');

    }

    //Получение.
    public function receipt()
    {
        Session::forget('sale'); //удалить переменную 'sale' - очистить предыдущую операцию.
        $_sklad = Cookie::get('sklad'); //торговая точка.
        session()->put('sklad', $_sklad);
        $contragents = Sklad::where('title', '<>', $_sklad)-> get();
        session()->put('contragents', $contragents);
        session()->put('operation', 'получение');
        session()->put('priznak', '-1');
        session()->put('user', Auth::user()->name);  //кто user?

        return Redirect::to('/buy');

    }

    //Возврат.
    public function refund()
    {
        Session::forget('sale'); //удалить переменную 'sale' - очистить предыдущую операцию.
        $contragents = Contragent::where('group', 'Покупатели')-> get();
        session()->put('contragents', $contragents);
        session()->put('operation', 'возврат');
        session()->put('priznak', '-1');
        session()->put('user', Auth::user()->name);  //кто user?
        session()->put('sklad', Cookie::get('sklad')); //торговая точка.

        return Redirect::to('/buy');

    }

    //Брак.
    public function discard()
    {
        Session::forget('sale'); //удалить переменную 'sale' - очистить предыдущую операцию.
        $contragents = Contragent::where('group', 'Поставщики')-> get();
        session()->put('contragents', $contragents);
        session()->put('operation', 'брак');
        session()->put('priznak', '1');
        session()->put('user', Auth::user()->name);  //кто user?
        session()->put('sklad', Cookie::get('sklad')); //торговая точка.

        return Redirect::to('/buy');

    }


    //Форма.
    public function buy(Request $request)
    {
        $oper = session('operation'); //получить тип операции.
        $contr = 'точка'; //контрагент.
        if (($oper == 'покупка')||($oper == 'брак')){$contr = 'поставщик';}
        if (($oper == 'продажа')||($oper == 'возврат')){$contr = 'покупатель';}
        if (($oper == 'выдача')||($oper == 'получение')){$contr = 'точка';}
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
                'oper' => $oper,
                'contr' => $contr,
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

                $jur = new Jurnal();            //новая операция для таблицы 'jurnals'.

                if (session('operation')=='выдача' || session('operation')=='получение')
                {$jur -> contragent = Sklad::find(session('contragent'))->title;} //точка.
                else
                {$jur -> contragent = Contragent::find(session('contragent'))->title;} //контрагент.

                $jur -> sklad = session('sklad');         //тор.точка.
                $jur -> operation = session('operation'); //тип операции.
                $jur -> priznak = session('priznak');     //признак операции.
                $jur -> user = session('user');           //ползователь.
                $jur->save();          //записать в таблицу Jurnal.

                $sum = 0; //сумма выбранного товара.

                foreach ($sales as $sale => $id) //записать в Detal все выбранные записи.
                {
                    $prod = new Detal();             //новая запись выбранного товара.
                    $art = Article::find($sale);     //товар из articles - выбран по ID
                    $kol = session('sale.' . $sale);  //из сессии берём количество - по ID
                    $prod->jurnal_id = $jur->id;      //id операции.
                    $prod->kol = $kol;                //добавляем количество
                    $prod->article_id = $art->id;     //id товара
                    $prod->title = $art->title;       //название товара

                    if (session('operation')=='покупка' || session('operation')=='брак')
                        {$prod->cena = $art->cena_in;}     //цена покупки.
                    else
                        {$prod->cena = $art->cena_out;}    //цена продажи.

                    $sum = $sum + ($prod->cena)* $kol;     //суммирование цены.

                    $prod->save();                         //записать в таблицу Detal.

                }

                $jur2 = Jurnal::find($jur->id); //последняя добавленная запись в журнал.
                $jur2->sum = $sum;              //записать сумму товара для этой операции.
                $jur2->save();                  //сохранить.

                Session::forget('sale'); //удалить переменную 'sale'.
               // Session::flush(); //полностью очистить сессию.
                Session::flash('message', 'Успешно!');
            }
        }

        return redirect()->action('JurnalsController@detals', ['id' => $jur2]);
    }

//-------------------------------------------------------
    //Удаление записи из журнала.
    public function deljur($id)
    {
        $jurnal = Jurnal::find($id);
        $jurnal -> delete();

        //удалить все записи товара из detals вязанные с этой проводкой.
        $ddetals =  Detal::where(['jurnal_id' => $id])->delete();

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

        $str_date = $request ->input("date_1");     //получить строку из запроса.
        $date = date_create($str_date.' 00:00:00'); //создать датую
        $date = date_format($date,"Y-m-d H:i:s");   //вывести в нужном формате.
        $date_start = date($date, time());          //начало периода

        $str_date = $request ->input("date_2");
        $date = date_create($str_date.' 23:59:59');
        $date = date_format($date,"Y-m-d H:i:s");
        $date_end = date($date, time());            //конец периода


        $request->session()->put('filter.contragent', $contragent);
        $request->session()->put('filter.sklad', $sklad);
        $request->session()->put('filter.operation', $operation);
        $request->session()->put('filter.date_start', $date_start);
        $request->session()->put('filter.date_end', $date_end);


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

        /*-----------------  фильтрация ------------------*/
        $jurnals = Jurnal::where('contragent',$sign ,$value)
            -> where('sklad',$sign2 ,$value2)
            -> where('operation',$sign3 ,$value3)
            -> whereBetween('created_at', [$date_start, $date_end])
            /*-> whereBetween('created_at', ['2017-03-22 00:00:00', '2017-04-23 23:59:59'])*/
            -> orderBy('created_at','DESC')-> paginate(12);

        $links = str_replace('/?', '?', $jurnals->render());

        return view('site.jurnals.view',
            [
                'jurnals' => $jurnals,
                'links' => $links,
            ]);
    }

    /*------------- сбросить фильтр ----------------------*/
    public function clear()
    {
        Session::forget('filter'); //удалить переменную 'sale'.
        return Redirect::to('/jurnal');
    }
    
    
    public function test()
    {
        
    return view('site.jurnals.test');        
        
    }

    //Вывод спискатоваров в операции.
    public function detals($id) //в id - номер операции в журнале
    {
        $products = Detal::where('jurnal_id', $id)-> get();
        $jurnal = Jurnal::find($id);
        return view('site.jurnals.detals',
           [ 
            'products' => $products,  
            'jurnal' => $jurnal,
        ]);

    }

    /*------------- наличие  ----------------------*/
    public function balance()
    {
        $detals = Detal::all(); //все товары.
        $list = array();
        foreach ($detals as $row) {

             $item['article_id']= $row->article_id;
             $item['title']= $row->title;
             $item['sklad']= $row->jurnal->sklad;
             $item['cena']= $row->cena;
             $item['kol']= $row->kol;
             $item['jurnal_id']= $row->jurnal_id;
             $item['priznak']= $row->jurnal->priznak;
             $list[] = $item;
        }

        $detals = array();
        foreach ($list as $row){
            //если массив пустой - добавить полностью.
           if(!count($detals)>0)
            {
                $row['kol'] = $row['kol'] * $row['priznak'] * (-1);
                $detals[]= $row;
            }
           else
            {
                $t=0; //признак повторения.
                foreach ($detals as $key => $rew)
                {
                    if (($rew['article_id'] == $row['article_id'])&&($rew['sklad'] == $row['sklad']))
                    {
                       $rew['kol'] = $rew['kol'] + ($row['kol'] * $row['priznak'] * (-1) );
                       $detals[$key] = $rew;
                       $t=1; //были совпадения.

                    }
                }
                if ($t==0){
                    $row['kol'] = $row['kol'] * $row['priznak'] * (-1);
                    $detals[]= $row;
                }
            }
        }

        return view('site.jurnals.balance',
            [
                'detals' => $detals,
            ]);
    }    

}
