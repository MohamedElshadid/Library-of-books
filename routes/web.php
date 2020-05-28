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
    Route::get('/admin/book/{id}', 'HomeController@showBook')->name('showBook');
    Route::get('/CategoriesPage','CategoryController@index')->name('CategoriesPage');

    
    
    //category routes
    Route::resource('categories', 'CategoryController');
    //list books in specific category 
    Route::get('addbook/{id}','BookController@index');
    //store book info in category 
    
    Route::post('store','BookController@store');
    Route::put('updateBook/{id}','BookController@update')->name('updateBook');
    //delete book from category
    Route::POST('category/bookDestroy/{id}','BookController@destroy');
    ###################################################
    // Route::resource('users', 'UserController');
    Route::get('users/{user}/editAdmin', 'UserController@editAdmin')->name('users.editAdmin');
    Route::patch('users/{user}/updateAdmin', 'UserController@updateAdmin')->name('users.updateAdmin');
    
    ################################
    Route::get('/admins', 'UserController@showAdmin')->name('admins.showAdmin');
    Route::get('users/{users}/removeAdmin', 'UserController@removeAdmin')->name('users.removeAdmin');
    
    Route::get('/users', 'UserController@showUser')->name('users.showUser');
    Route::get('users/{users}/makeAdmin', 'UserController@makeAdmin')->name('users.makeAdmin');
    
    Route::get('users/{users}/deactivate', 'UserController@deactivate')->name('users.deactivate');
    Route::get('users/{users}/activate', 'UserController@activate')->name('users.activate');
    Route::get('reports', 'UserChartController@index')->name('admin.report');
    #############################################



});


// URL::asset('path/to/asset');

Route::middleware('user')->group(function (){ 
    Route::get('/userDashbord', 'DetailsController@userIndex')->name('userHome');
    Route::get('lease/{id}', 'DetailsController@lease')->name('books.lease');
    Route::get('view/{id}', 'DetailsController@view')->name('books.view');

    Route::get('category/{id}', 'UserHomeController@handleCategory');
    Route::get('category', 'UserHomeController@allCategory')->name('all');
    Route::get('mybook', 'UserHomeController@mybooks')->name('mybook');
    Route::get('/search', 'UserHomeController@handleSearch')->name('search');
    Route::get('/latest', 'UserHomeController@handleLatest')->name('sort.latest');
    Route::get('/rate', 'UserHomeController@handleRate')->name('sort.rate');
    Route::post('lease', 'DetailsController@savelease')->name('savelease');
    Route::get('book/{id}', 'DetailsController@view')->name('books.view');
    Route::post('book/{id}/rating', 'DetailsController@rating')->name('books.rating');
    // Route::get('comments/{id}','CommentController@destroy');

    Route::get('users/{user}/editUser', 'UserController@editUser')->name('users.editUser');
    Route::patch('users/{user}/updateUser', 'UserController@updateUser')->name('users.updateUser');

    Route::resource('comments', 'CommentController');


    Route::get('addFav','FavouriteController@storeOrUpdate');
    Route::get('myFavourites', 'FavouriteController@index')->name('myFavourites');

});

