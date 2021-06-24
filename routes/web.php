<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

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
Route::get('/cart/destroy/{itemId}', [App\Http\Controllers\cartController::class, 'destroy'])->name('cart.destroy')->middleware('auth');
Route::get('/cart/update/{itemId}', [App\Http\Controllers\cartController::class, 'update'])->name('cart.update')->middleware('auth');
Route::get('/cart/checkout', [App\Http\Controllers\cartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');
//Route::get('/cart/checkout', [App\Http\Controllers\cartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');
Route::resource('orders','App\Http\Controllers\OrderController')->middleware('auth');

Route::get('paypal/checkout/', [App\Http\Controllers\PayPalController::class, 'getExpressCheckout'])->name('paypal.checkout');
Route::get('paypal/checkout-success/', [App\Http\Controllers\PayPalController::class, 'getExpressCheckoutSuccess'])->name('paypal.success');
Route::get('paypal/checkout-cancel', [App\Http\Controllers\PayPalController::class, 'cancelPage'])->name('paypal.cancel');
