<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expense;
use App\Apartment;

class expensesController extends Controller
{
    public function index(){
        $Apartment = Apartment::orderBy('id', 'desc')->take(10)->get();
        return view('expenses',compact('Apartment'));
        
    }

    
    public function store(Request $req){
        $apartment = Expense::create([
            'payment_period' =>$req->input('payment_period'),
            'currency' =>$req->input('currency'),
            'item' =>$req->input('item'),
            'listing_id' =>$req->input('listing_id'),
        ]);
        return redirect('expenses');
    }
}
