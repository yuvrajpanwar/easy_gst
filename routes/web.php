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
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/home', [App\Http\Controllers\HomeController::class, 'create_receipt']);

Route::get('/product_list', [App\Http\Controllers\HomeController::class, 'product_list'])->name('product_list');

Route::get('/add_product', [App\Http\Controllers\HomeController::class, 'add_product'])->name('add_product');

Route::post('/add_product', [App\Http\Controllers\HomeController::class, 'create_product'])->name('create_product');

Route::post('/get_max_date', [App\Http\Controllers\HomeController::class, 'get_max_date'])->name('get_max_date');

Route::post('/calculate_amount', [App\Http\Controllers\HomeController::class, 'calculate_amount'])->name('calculate_amount');
