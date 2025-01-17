<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return view('welcome');
});


Route::middleware('api')->prefix('api')->group(function(){
    Route::resource('productos', ProductoController::class);
});

