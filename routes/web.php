<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Auth::routes();
Route::get('/', function () {
    return view('auth.login');
});
Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');
Route::middleware('admin')->group(function (){
    Route::get('chart-js','chartController@index');
    Route::get('relatedBooks','BookController@related_books');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/home/{id}', 'HomeController@destroy')->name('homeDestroy');
    Route::get('/CategoriesPage','CategoryController@index')->name('CategoriesPage');

    //routes used in category & books  part (maryam)
    
    
    //category routes
    Route::resource('categories', 'CategoryController');
    //list books in specific category 
    Route::get('category/{id}','BookController@index');
    //store book info in category 
    
    Route::post('store','BookController@store');
    //delete book from category
     Route::get('category/bookDestroy/{id}','BookController@destroy');
     ###################################################
    // Route::resource('users', 'UserController');
    Route::get('users/{user}/edit', 'UserController@editAdmin')->name('users.editAdmin');
    Route::patch('users/{user}/update', 'UserController@updateAdmin')->name('users.updateAdmin');
    
    ################################
    Route::get('/admins', 'UserController@showAdmin')->name('admins.showAdmin');
    Route::get('users/{users}/removeAdmin', 'UserController@removeAdmin')->name('users.removeAdmin');
    
    Route::get('/users', 'UserController@showUser')->name('users.showUser');
    Route::get('users/{users}/makeAdmin', 'UserController@makeAdmin')->name('users.makeAdmin');
    
    Route::get('users/{users}/deactivate', 'UserController@deactivate')->name('users.deactivate');
    Route::get('users/{users}/activate', 'UserController@activate')->name('users.activate');
    #############################################



});


// URL::asset('path/to/asset');

Route::middleware('user')->group(function (){ 
    Route::get('/userDashbord', 'DetailsController@userIndex')->name('userHome');
    Route::get('/search', 'DetailsController@handleSearch')->name('search');
    Route::get('lease/{id}', 'DetailsController@lease')->name('books.lease');
    Route::get('view/{id}', 'DetailsController@view')->name('books.view');
   

});

