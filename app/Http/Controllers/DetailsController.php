<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Category;
class DetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function related_books(Request $request){
        $book_id=$request->input('book_id');
        $category_id=Book::where('id','=',$book_id)->get("category_id")->first();
        $books=Book::where('category_id','=',$category_id["category_id"])->where('id','!=', $book_id)->get();
        return view("relatedBooks",["books" => $books]);
    }
    public function userIndex(Request $request)
    {
        $books=\App\Book::simplePaginate(4);
        $catagory = \App\Category::all();

        return view("userShow", ['books'=>$books, "catagory" => $catagory]);
    }

    public function lease($id)
    {
        // dd($id);
      
        $book = Book::find($id);
        if($book->available_copies > 0){
            $book->decrement('available_copies');
        }
        return redirect()->route('userHome');

    }

    public function view($id){
        $book = Book::find($id);
        return view('BookDetails',['books'=>$book]);

    }
}
