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
        //list favourites for each user
        $favourites = DB::table('books')
        ->join('favourites','favourites.book_id','=', 'books.id' )
        ->where('favourites.user_id','=',Auth::id())
        ->get();
        $fav= \App\User::find(Auth::id())->favorites()->pluck('book_id')->all();

        
        return view('FavouritesPage',['favourites'=>$favourites,"favs"=>$fav]);
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

        // $favourite=new Favourite ;
        // $favourite->book_id =$request->bookID;
        // $favourite->user_id=Auth::id();
        // if(Favourite::where('user_id LIKE' . Auth::id() .' and book_id LIKE  '.$request->book_id) {
            
        //     } else {
        //         $favourite->save();
        //     }
       
             $favourite=Favourite::firstOrNew(['book_id' => $request->bookID , 'user_id'=> Auth::id()]);
                // $favourite->book_id =$request->bookID;
                // $favourite->user_id=Auth::id();
                $favourite->save();
        
    //redirect
    return redirect()->route('home');
    }
    public function storeOrUpdate(Request $request)
    {
        // dd($request->all());
        \App\User::find(Auth::id())->favorites()->toggle($request->bookID);
        return redirect()->back();
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
