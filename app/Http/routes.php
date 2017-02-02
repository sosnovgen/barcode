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

Route::delete('/cat/{id}',
  [  'as' => 'cat',
   'uses' => 'CategoriesController@destroy']);

Route::get('/treecats','CategoriesController@treecats');