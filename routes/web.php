<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SubcontractorController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('work', WorkController::class);
Route::resource('project', ProjectController::class);
Route::resource('task', TaskController::class);
Route::resource('subcontractor', SubcontractorController::class);
Route::resource('user', UserController::class);


Route::get('task/create/{project}',[TaskController::class,'createTaskForProject'])->name('task.create');
Route::get('work_create/{task}',[WorkController::class,'create'])->name('work.create');
Route::get('work_copy/{work}',[WorkController::class,'copy_work'])->name('work.copy');

Route::put('project/multipleWorkUpdate/{project}', [WorkController::class,'multipleUpdate'])->name('work.multipleUpdate');

Route::get('/weekly',[WorkController::class,'weekly'])->name('weekly');;
Route::post('/weekly_with_base_date',[WorkController::class,'weekly_with_base_date'])->name('weekly.with_date');;

