<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SubcontractorController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('work', WorkController::class);
Route::resource('project', ProjectController::class);

Route::resource('task', TaskController::class);
Route::resource('subcontractor', SubcontractorController::class);
Route::get('task/create/{project}',[TaskController::class,'createTaskForProject'])->name('task.create');
Route::get('task_create/{task}',[WorkController::class,'create'])->name('work.create');


Route::put('project/multipleWorkUpdate/{project}', [WorkController::class,'multipleUpdate'])->name('work.update');

Route::get('/weekly',[WorkController::class,'weekly'])
->name('/weekly');
