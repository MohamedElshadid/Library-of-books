<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
class BookController extends Controller
{
    //


    public function related_books(Request $request){
        $book_id=$request->input('book_id');
        $category_id=Book::where('id','=',$book_id)->get("category_id")->first();
        $books=Book::where('category_id','=',$category_id["category_id"])->where('id','!=', $book_id)->get();
        return view("relatedBooks",["books" => $books]);
    }
}
