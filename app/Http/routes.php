<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('site.front.index');
});*/

Route::resource('articles','ArticlesController');
Route::resource('categories','CategoriesController');
Route::resource('groups','GroupsController');
Route::resource('atributes','AtributesController');
Route::resource('sklads','SkladController');
Route::resource('contragents','ContragentsController');

Route::get('addatribute/{id}','AtributesController@add');   //добавить атрибут
Route::get('addatribute2/{id}','AtributesController@add2'); //добавить атрибут
Route::get('tample/{id}','AtributesController@tample');     //сохранить как шаблон.
Route::get('load/{id}','AtributesController@load');         //загрузить шаблон.

/*-----------  delete ----------------------------------*/
Route::delete('/cat/{id}',
  [  'as' => 'cat',
   'uses' => 'CategoriesController@destroy']);

Route::delete('/group/{id}',
    [  'as' => 'group',
        'uses' => 'GroupsController@destroy']);

Route::delete('/article/{id}',
    [  'as' => 'article',
     'uses' => 'ArticlesController@destroy']);

Route::delete('atribute/{id}',
    [  'as' => 'atribute',
     'uses' => 'AtributeController@destroy']);

Route::delete('sklad/{id}',
    [  'as' => 'sklad',
        'uses' => 'SkladController@destroy']);


/*--------------------------------------------*/
Route::get('articlesort/{id}','ArticlesController@indexid');

Route::get('/treecats','CategoriesController@treecats');

Route::auth();

Route::get('/', 'HomeController@index');

Route::post('/find', 'ArticlesController@find');

/*------------------ Движение  ------------------------*/
Route::post('/sklad', 'HomeController@sklad'); //выбор склада.
Route::get('/delsklad', 'HomeController@delsklad'); //удалить склад.

Route::get('/jurnal', 'JurnalsController@index');
Route::get('/detals/{id}', 'JurnalsController@detals'); //детали проводки.
Route::post('/session', 'JurnalsController@session');
Route::get('/balance', 'JurnalsController@balance'); //наличие (общее).
Route::get('/balance2/{id}', 'JurnalsController@balance2'); //наличие на точке.

Route::post('/count/{id}/{kol}','JurnalsController@count'); //изменить кол. тов.
Route::get('/buy', 'JurnalsController@buy'); //форма.

Route::get('/purchase', 'JurnalsController@purchase'); //Покупка.
Route::get('/sale', 'JurnalsController@sale'); //Продажа.
Route::get('/delivery', 'JurnalsController@delivery'); //Выдача.
Route::get('/receipt', 'JurnalsController@receipt'); //Получение.
Route::get('/refund', 'JurnalsController@refund'); //Возврат.
Route::get('/discard', 'JurnalsController@discard'); //Брак.

Route::get('/del/{id}', 'JurnalsController@del'); //удаление товара.
Route::delete('/deljur/{id}', 'JurnalsController@deljur'); //удаление записи из журнала.
Route::get('/order', 'JurnalsController@order'); //провести операцию.

Route::post('/filter', 'JurnalsController@filter'); //применить фильтр.
Route::get('/clear', 'JurnalsController@clear'); //сбросить фильтр.

Route::post('/report', 'JurnalsController@report'); //вывести отчёт.
Route::post('/excel', 'JurnalsController@excel'); //вывести отчёт в Exel.

Route::get('/test', 'JurnalsController@test'); //тестовая страница.

