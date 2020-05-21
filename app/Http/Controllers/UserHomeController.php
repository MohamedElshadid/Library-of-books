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
            $books = Book::where("title", "like", "$userSearch")->orWhere("author", "like", "$userSearch")->simplePaginate(4);
            return view("userShow", ["books" => $books, "catagory" => $catagory]);
        } else {
            $books=Book::simplePaginate(4);
            $catagory = Category::all();
            return view("userShow", ['books'=>$books, "catagory" => $catagory]); 
        }
        

    }
    function handleLatest() {
        $catagory = Category::all();
        $books = Book::orderBy('created_at', 'DESC')->simplePaginate(4);
        return view("userShow", ['books'=>$books, "catagory" => $catagory]); 
    }
    function handleRate() {
        $catagory = Category::all();
        $rates = Rate::select('book_id')->orderBy('rate','DESC')->get('book_id');
        foreach($rates as $rate)
        {

            $books=Book::findOrFail ($rate['book_id']);
            var_dump($books);
            return view("userShow", ['books'=>$books, "catagory" => $catagory]); 
            
        }
        
    }
    function handleCategory($category)
    {        
            $catagory = Category::all();
            $books = Book::where("category_id", $category)->simplePaginate(4);
            return view("userShow", ["books" => $books, "catagory" => $catagory]);

    }
    function mybooks()
    {        
        //dd(Auth::user()->leases);
        return view('mybook', ['books' => Auth::user()->leases]);

    }
}
