<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\Book;
use App\Category;
use App\Lease;
use App\Rate;

use Carbon\Carbon;
use Auth;

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

    public function userIndex(Request $request)
    {
        $books=\App\Book::simplePaginate(4);
        $catagory = \App\Category::all();
        $data = Lease::all();
        foreach($data as $obj){
            if ($obj->expire_date == Carbon::today()->toDateString()){
                $book = Book::find($obj->book_id);
               $book->increment('available_copies');
               $obj->delete(); 
            }
        }
        
        return view("userShow", ['books'=>$books, "catagory" => $catagory]);
    }


    public function savelease(Request $request){
        $data = $request->all();
        $data = $request->input('book');
        $obj = json_decode($data,true);
        $bklease= new Lease;
        $bklease->book_id =$obj['id'];
        $bklease->user_id = Auth::user()->id;
        $bklease->price =$obj['price'];
        $bklease->date = Carbon::now();
        $bklease->expire_date=Carbon::now()->addDays($request['days']);
        $bklease->save();
        $book = Book::find($obj['id']);
        if($book->available_copies > 0 && $request['days']>0){
            $book->decrement('available_copies');
        }
        return redirect()->route('userHome');

    }

    public function view($id){
        $book = Book::find($id);
        $category_id=Book::where('id','=',$id)->get("category_id")->first();
        $relbooks=Book::where('category_id','=',$category_id["category_id"])->where('id','!=', $id)->get();
        $rate=Rate::where('user_id','=',Auth::user()->id)->where('book_id','=',$id)->first();
        if(!$rate)
        {
            return view('BookDetails',['books'=>$book ,'relbooks'=>$relbooks,'rate'=>0]);

        }
        return view('BookDetails',['books'=>$book ,'relbooks'=>$relbooks,'rate'=>$rate->rate]);


    }

    public function rating($id, Request $request)
    {
        $book = Book::find($id);
        $rate = Rate::updateOrCreate(
            ['book_id' => $id, 'user_id' => Auth::user()->id],
            ['rate' => $request->get('rating')]
        );
        // dd($rate);
        // return [ 'rate' => $rate->rate];

         //return view('BookDetails',[ 'rate' => $rate->rate ,'books'=>$book]);
        return redirect()->back()->with('success', 'Thank you for rating.');
    }

    // public function getRate()
    // {
    //     return number_format(\DB::table('rates')->where('book_id', $this->attributes['id'])->average('rating'), 2);
    // }

}
