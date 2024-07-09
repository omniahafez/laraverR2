<?php

namespace App\Http\Controllers;

use App\Models\Beverage;
use Illuminate\Http\Request;
use App\Models\Taq;

class FrontPage extends Controller
{
    public function home (){ 
        // $taqs= Taq::take(3)->get();
        // //$taqs = Taq::with('beverages')->get();
        // $beverages = Beverage::get ();

        // Retrieve all taqs with their associated beverages
    $taqs = Taq::with('beverages')->get();


    $specialBeverages = Beverage::where('special', 1)->get();
        return view('home2',compact('taqs','specialBeverages'));
    }
}
