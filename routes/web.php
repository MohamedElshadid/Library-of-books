<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('chart-js','chartController@index');
Route::get('relatedBooks','BookController@related_books');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//routes used in category & books  part (maryam)

//category routes
Route::resource('categories', 'CategoryController');
//list books in specific category 
Route::get('category/{id}','BookController@index');
//store book info in category 

Route::post('store','BookController@store');
//delete book from category
 Route::get('category/bookDestroy/{id}','BookController@destroy');
 
Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
