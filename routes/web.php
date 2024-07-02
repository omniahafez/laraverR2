<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontPage;

//Route::get('/', function () {
   // return view('test');
//});

Route::get('/',[Frontpage::class,'home'])->name('home');
