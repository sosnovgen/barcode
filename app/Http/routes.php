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

Route::get('/', function () {
    return view('site.front.index');
});

Route::resource('articles','ArticlesController');
Route::resource('categories','CategoriesController');
Route::resource('groups','GroupsController');
Route::resource('atributes','AtributesController');

Route::get('addatribute/{id}','AtributesController@add'); //добавить атрибут
Route::get('addatribute2/{id}','AtributesController@add2'); //добавить атрибут
Route::get('tample/{id}','AtributesController@tample'); //сохранить как шаблон.

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

/*--------------------------------------------*/
Route::get('articlesort/{id}','ArticlesController@indexid');

Route::get('/treecats','CategoriesController@treecats');
