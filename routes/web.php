<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\TruckController::class, 'index'])->name('index');
Route::post('/store', [App\Http\Controllers\TruckController::class, 'store'])->name('store');
Route::get('/table', [App\Http\Controllers\TruckController::class, 'table'])->name('table');

