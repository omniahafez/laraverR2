<?php

namespace App\Http\Controllers;

use App\Models\Beverage;
use App\Models\Taq;

class FrontPage extends Controller
{
    public function home (){ 
        
    // Retrieve all taqs with their associated beverages
    $taqs = Taq::with('beverages')->get();


    $specialBeverages = Beverage::where('special', 1)->get();
        return view('home2',compact('taqs','specialBeverages'));
    }
}
