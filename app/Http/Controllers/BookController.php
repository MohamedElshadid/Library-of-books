<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BookController;
use App\Book;
use DB;
use Auth ;
use Redirect;
use Illuminate\Support\Facades\Input;
class BookController extends Controller
{
    //



    public function index($id)
    {
        
        //list books in specific category 
        $books = DB::select('select * from books  where  books.category_id like '. $id .' and  books.deleted_at is NULL' );
        //  var_dump( $books);
        return view('CategoryInfo',['books'=>$books]);

    }
    public function create(Request $request)
    {

    //create book form 

    return view('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'unique:books', 'max:255'],
            'author' => ['required'],
            'available_copies' => ['required','numeric','min:0'],
            'cover' => ['required'],
            'price' => ['required','numeric','min:0'],

        ]);

      
        //store data of book to category
        $book=new Book ;
        $book->id=$request->id;
        $book->title=$request->title;
        $book->author=$request->author;
        $book->available_copies=$request->available_copies;
        
        $bookImage = time() . '.' . $request['cover']->getClientOriginalExtension();

        $request['cover']->move(
        base_path() . '/public/storage', $bookImage); 
        $book->cover=$bookImage;

        $book->price=$request->price;
        $book->category_id=$request->category_id;
        $book->save();
    //redirect
          return redirect()->back();
    
   
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete book from db 
        $book =Book::find($id);
        $book->delete();
        return redirect ('/category/'.$book->category_id);
    }

  
}