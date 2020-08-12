<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Book;
use \App\Rate;
use \App\Category;
use Auth;

class UserHomeController extends Controller
{
    //
    function handleSearch(Request $request)
    {
        $userSearch = $request->search;
        if($userSearch !=''){
            $catagory = Category::all();
            $books = Book::where("title", "like", "$userSearch")->orWhere("author", "like", "$userSearch")->simplePaginate(3);
            $fav= \App\User::find(Auth::id())->favorites()->pluck('book_id')->all();

            return view("userShow", ["books" => $books, "catagory" => $catagory,"fav"=>$fav]);
        } else {
            $books=Book::simplePaginate(3);
            $catagory = Category::all();
            $fav= \App\User::find(Auth::id())->favorites()->pluck('book_id')->all();
            return view("userShow", ["books" => $books, "catagory" => $catagory,"fav"=>$fav]);
        }
        

    }
    function handleLatest() {
        $catagory = Category::all();
        $books = Book::orderBy('created_at', 'DESC')->simplePaginate(3);
        $fav= \App\User::find(Auth::id())->favorites()->pluck('book_id')->all();
        return view("userShow", ["books" => $books, "catagory" => $catagory,"fav"=>$fav]);
        }
    function handleRate() {
        $catagory = Category::all();
        $rates = Rate::select('book_id')->orderBy('rate','DESC')->get('book_id');
        foreach($rates as $rate)
        {

            $books=Book::findOrFail ($rate['book_id']);
            var_dump($books);
            $fav= \App\User::find(Auth::id())->favorites()->pluck('book_id')->all();
            return view("userShow", ["books" => $books, "catagory" => $catagory,"fav"=>$fav]);            
        }
        
    }
    function handleCategory($category)
    {        
            $catagory = Category::all();
            $books = Book::where("category_id", $category)->simplePaginate(3);
            $fav= \App\User::find(Auth::id())->favorites()->pluck('book_id')->all();
            return view("userShow", ["books" => $books, "catagory" => $catagory,"fav"=>$fav]);    }
    function allCategory()
    {        
            $catagory = Category::all();
            $books = Book::simplePaginate(3);
            $fav= \App\User::find(Auth::id())->favorites()->pluck('book_id')->all();
            return view("userShow", ["books" => $books, "catagory" => $catagory,"fav"=>$fav]);    }
    function mybooks()
    {        
        //dd(Auth::user()->leases);
        $books = Auth::user()->leases()->simplePaginate(3);
        return view('mybook', ['books' => $books]);

    }
}
