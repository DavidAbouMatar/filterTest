<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
// use Illuminate\Support\Carbon;
use App\Expense;
use App\Apartment;
use Carbon\Carbon;
class listController extends Controller

{
    public function index(){
      $atribute = 'created_at';
      $operator= '>';
      $date='2021-04-25';
      $filter = Apartment::select('*')->join('expenses','expenses.listing_id' , '=', 'apartments.id')
      ->where('expenses.'.$atribute, $operator, $date)
      ->get();            
        // dd($filter);
        return view('list');
    }
    function fetch_data(Request $request)
    {
      $data = $request->all();
      $operator='';
      if($data['operator'] == 'is'){
        $operator = '=';
      }elseif($data['operator'] == 'is_not'){
        $operator = '!=';
      }elseif($data['operator'] == 'greater_than'){
        $operator = '>';
      }
      
      
      //if no filter applied fetch all data
      if($data['atribute'] =='Select An Atribute' || $data['operator'] =='Select An Operator' ){
        $filter = Apartment::select('*')->leftjoin('expenses','expenses.listing_id' , '=', 'apartments.id')->get();
        echo json_encode($filter);
       
      }elseif($data['atribute'] =='created_at' || $data['atribute'] =='payment_period'){
        $date= $data['datepicker'];
        $date1 =date('y-m-d', strtotime($date));
        $atribute= $data['atribute']; 

      //if time filter get dates according to filter
        $filter = Expense::select('*')->rightjoin('apartments','expenses.listing_id' , '=', 'apartments.id')
        ->where(DB::raw('DATE(expenses.'.$atribute.')'), $operator, $date1)
        ->get();
        echo json_encode($filter);
      }elseif($data['atribute'] =='currency') {
        //get data according to currency filter
        $filter = Apartment::select('*')->join('expenses','expenses.listing_id' , '=', 'apartments.id')
        ->where('expenses.currency', $operator, $data['currency'])
        ->get();
        echo json_encode($filter);
      }else{
        $filter = Apartment::select('*')->leftjoin('expenses','expenses.listing_id' , '=', 'apartments.id')
        ->where($data['atribute'], $operator, null)
        ->get();
        echo json_encode($filter);
      }

     
    }
}
