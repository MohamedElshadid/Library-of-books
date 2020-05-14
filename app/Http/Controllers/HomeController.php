<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $books=\App\Book::all();
        return view('home',['books'=>$books]);
    }
    public function destroy($id)
    {
        $book =\App\Book::find($id);
        $book->delete();
        return redirect()->route('home');

    }
    public function userIndex(Request $request)
    {
        $books=\App\Book::all();
        $catagory = \App\Category::all();

        return view("userShow", ['books'=>$books, "catagory" => $catagory]);
    }

}
