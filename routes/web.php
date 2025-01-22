<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('work', WorkController::class);
Route::resource('project', ProjectController::class);
Route::resource('task', TaskController::class);
Route::get('task/create/{project}',[TaskController::class,'createTaskForProject']);


Route::get('/weekly',[WorkController::class,'weekly'])
->name('/weekly');
