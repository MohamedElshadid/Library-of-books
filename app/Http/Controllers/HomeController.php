<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Book;
use \App\Comment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $books=\App\Book::all();
        $books=\App\Book::simplePaginate(3);
       

        return view('home',['books'=>$books]);
    }
    public function destroy($id)
    {
        $book =\App\Book::find($id);
        $book->delete();
        return redirect()->route('home');

    }
    public function showBook($id){
        $book = Book::find($id);
        $category_id=Book::where('id','=',$id)->get("category_id")->first();
        $comments = Comment::all();
        return view('BookPage',['books'=>$book ,'comments'=>$comments]);
    }


}
