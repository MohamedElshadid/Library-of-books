<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

use App\Book;
use App\Category;
use App\Lease;
use App\Comment;
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
        $books=\App\Book::simplePaginate(3);
        $catagory = \App\Category::all();
        $fav= \App\User::find(Auth::id())->favorites()->pluck('book_id')->all();
        //dd($fav);
        $data = Lease::all();
        foreach($data as $obj){
            if ($obj->expire_date == Carbon::today()->toDateString()){
                $book = Book::find($obj->book_id);
               $book->increment('available_copies');
               $obj->delete(); 
            }
        }
        
        return view("userShow", ['books'=>$books, "catagory" => $catagory,"fav"=>$fav]);
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
    public static function getChartData()
    {
        $data = DB::table('leases')
            ->select('date', 'price')
            ->get();
        $chartData = array();
        $profit = 0;
        $index = 1;
        $first = DB::table('leases')->select('date')->get()->first();
        $week = (new Carbon($first->date))->addDays(6);

        foreach ($data as $obj) {
            if ($obj->date <= $week) {
                $profit += $obj->price;
            } else {
                $chartData[] = ['week' => 'Week '.$index++, 'profit' => $profit];
                $profit = $obj->price;
                $week = (new Carbon($first->date))->addDays(7);
                $first->date = $week;
            }
        }
        $chartData[] = ['week' => 'Week '.$index++, 'profit' => $profit];

        return  $chartData;
    }
    public static function getLeaseDate(array $cahrtData)
    {
        $dates = array();
        foreach ($cahrtData as $date) {
            $dates[] = $date['week'];
        }

        return $dates;
    }
    public static function getLeaseProfits(array $cahrtData)
    {
        $profits = array();
        foreach ($cahrtData as $profit) {
            $profits[] = $profit['profit'];
        }

        return $profits;
    }
    public function view($id){
        $book = Book::find($id);
        $category_id=Book::where('id','=',$id)->get("category_id")->first();
        $comments = Comment::all();
        $relbooks=Book::where('category_id','=',$category_id["category_id"])->where('id','!=', $id)->get();
        $rate=Rate::where('user_id','=',Auth::user()->id)->where('book_id','=',$id)->first();
        $fav= \App\User::find(Auth::id())->favorites()->pluck('book_id')->all();
        if(!$rate)
        {
            return view('BookDetails',['books'=>$book ,'relbooks'=>$relbooks, 'comments'=>$comments,"fav"=>$fav,'rate'=>0]);

        }
        return view('BookDetails',['books'=>$book ,'relbooks'=>$relbooks, 'comments'=>$comments,'rate'=>$rate->rate,"fav"=>$fav]);


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



    public function categoryBooks($id)
    {
        
        //list books in specific category 
        $books = DB::select('select * from books  where  books.category_id like '. $id .' and  books.deleted_at is NULL' );
        //  var_dump( $books);
        return view('categoryBooks',['books'=>$books]);

    }
    // public function getRate()
    // {
    //     return number_format(\DB::table('rates')->where('book_id', $this->attributes['id'])->average('rating'), 2);
    // }

}
