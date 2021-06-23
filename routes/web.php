<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!//
|
*/

Route::redirect('/', '/home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/add-to-cart/{product}', [App\Http\Controllers\cartController::class, 'add'])->name('cart.add')->middleware('auth');
Route::get('/cart', [App\Http\Controllers\cartController::class, 'index'])->name('cart.index')->middleware('auth');
