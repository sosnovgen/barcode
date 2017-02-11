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

Route::delete('/cat/{id}',
  [  'as' => 'cat',
   'uses' => 'CategoriesController@destroy']);

Route::delete('/group/{id}',
    [  'as' => 'group',
        'uses' => 'GroupsController@destroy']);

Route::delete('/article/{id}',
    [  'as' => 'article',
     'uses' => 'ArticlesController@destroy']);

Route::get('articlesort/{id}','ArticlesController@indexid');

Route::get('/treecats','CategoriesController@treecats');