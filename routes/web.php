<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('work', WorkController::class);


Route::get('/weekly',[WorkController::class,'weekly'])
->name('/weekly');
