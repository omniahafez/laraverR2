<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontPage extends Controller
{
    public function home (){ 
        return view('home2');
    }
}
