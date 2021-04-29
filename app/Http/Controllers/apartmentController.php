<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;

class apartmentController extends Controller
{
    public function index(){
        return view('apartments');
    }

    public function store(Request $req){
        $apartment = Apartment::create([
            'name' =>$req->input('name'),
            'abbreviation' =>$req->input('abbreviation'),
        ]);
        return redirect('apartment');
    }
}
