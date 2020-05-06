<?php
   
namespace App\Http\Controllers;
 
use App\Lease;
use App\Book;
use Illuminate\Http\Request;
use Redirect,Response;
Use DB;
use Carbon\Carbon;
 
class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
$my_views=Book::all();
 $record = Lease::select(\DB::raw("SUM(price) as count"), \DB::raw("DAYNAME(date) as day_name"), \DB::raw("DAY(date) as day"))
    ->where('date', '>', Carbon::today()->subDay(6))
    ->groupBy('day_name','day')
    ->orderBy('day')
    ->get();
  
     $data = [];
 
     foreach($record as $row) {
        $data['label'][] = $row->day_name;
        $data['data'][] = (int) $row->count;
        
      }
 
    $data['chart_data'] = json_encode($data);
    return view('chart-js', $data);
    }
 
}
