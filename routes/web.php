<?php

use App\Http\Controllers\BeverageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontPage;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaqController;
use App\Http\Controllers\MessageController;
use App\Models\Message;

Route::get('/', function () {
   return view('welcome');
});

Route::get('home2',[Frontpage::class,'home'])->name('home2');

//Route::get('/', [UserController::class, 'index'])->middleware('verified')->name('dashboard.users');

Route::post('insertUser', [UserController::class,'store'])->name('insertUser');
Route::post('insertCategory', [TaqController::class,'store'])->name('insertCategory');
Route::post('insertBeverage', [BeverageController::class,'store'])->name('insertBeverage');
Route::post('insertMessage', [MessageController::class, 'store'])->name('insertMessage');




Route::prefix('dashboard')->group(function () {
    Route::get('/users', [UserController::class, 'index'])->middleware('verified')->name('dashboard.users');
    Route::get('/addUser', [UserController::class, 'create'])->name('dashboard.addUser');
    Route::get('/editUser/{id}', [UserController::class, 'edit'])->name('dashboard.editUser');
    Route::put('/updateUser/{id}', [UserController::class, 'update'])->name('dashboard.updateUser');

    Route::get('/categories', [TaqController::class, 'index'])->name('dashboard.categories');
    Route::get('/addCategory', [TaqController::class, 'create'])->name('dashboard.addCategory');
    Route::get('/editCategory/{id}', [TaqController::class, 'edit'])->name('dashboard.editCategory');
    Route::put('/updateCategory/{id}', [TaqController::class, 'update'])->name('dashboard.updateCategory');
    Route::delete('/delCategory',[TaqController::class, 'destroy'])->name('dashboard.delCategory');

    Route::get('/beverages', [BeverageController::class, 'index'])->name('dashboard.beverages');
    Route::get('/addBeverage', [BeverageController::class, 'create'])->name('dashboard.addBeverage');
    Route::get('/editBeverage/{id}', [BeverageController::class, 'edit'])->name('dashboard.editBeverage');
    Route::put('/updateBeverage/{id}', [BeverageController::class, 'update'])->name('dashboard.updateBeverage');
    Route::delete('/delBeverage',[BeverageController::class, 'destroy'])->name('dashboard.delBeverage');

    Route::get('/messages', [MessageController::class, 'index'])->name('dashboard.messages');
    Route::get('/showMessage/{id}', [MessageController::class, 'show'])->name('dashboard.showMessage');


});
Auth::routes(['verify'=> true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
