<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favourite;
use Auth;
use DB;
class FavouriteController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories=Category::all();
        return view('CategoriesPage',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //create category form 
        return view('CategoriesPage');
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //store favourite book to favourite list

        $favourite=new Favourite ;
        $favourite->book_id =$request->bookID;
        $favourite->user_id=Auth::id();
        $favourite->save();
    //redirect
    return redirect()->route('home');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(  $id)
    {
        $matchThese = ['book_id' => $id, 'user_id' => Auth::id(),'deleted_at'=>NULL];

        DB::table('favourites')->where($matchThese)->delete();
      
        return redirect ()->route('home');
    }
}
