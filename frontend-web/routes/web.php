<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VfrController;
// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/', [VfrController::class, 'index']);
Route::post('/try-on', [VfrController::class, 'tryOn']);