<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfGeneratorController;
use App\Http\Controllers\Auth\ResetPasswordController;

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

// Route::get('/', function () {
//     return view('login');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/home', [App\Http\Controllers\HomeController::class, 'create_receipt']);

Route::get('/product_list', [App\Http\Controllers\HomeController::class, 'product_list'])->name('product_list');

Route::get('/add_product', [App\Http\Controllers\HomeController::class, 'add_product'])->name('add_product');

Route::post('/add_product', [App\Http\Controllers\HomeController::class, 'create_product'])->name('create_product');

Route::get('edit_product',[App\Http\Controllers\HomeController::class, 'edit_product'])->name('edit_product');

Route::post('update_product/{id}',[App\Http\Controllers\HomeController::class, 'update_product'])->name('update_product');

Route::get('delete_product/{id}',[App\Http\Controllers\HomeController::class, 'delete_product'])->name('delete_product');

Route::post('/get_max_date', [App\Http\Controllers\HomeController::class, 'get_max_date'])->name('get_max_date');

Route::post('/calculate_amount', [App\Http\Controllers\HomeController::class, 'calculate_amount'])->name('calculate_amount');

Route::get('/receipt_list/{user_type?}', [App\Http\Controllers\HomeController::class, 'receipt_list'])->name('receipt_list');

Route::get('/edit_receipt/{user_type}/{id}' , [App\Http\Controllers\HomeController::class,'edit_receipt'])->name('edit_receipt');

Route::post('/update_receipt/{user_type}/{id}', [App\Http\Controllers\HomeController::class, 'update_receipt'])->name('update_receipt');

Route::get('/view_receipt/{user_type}/{id}', [App\Http\Controllers\HomeController::class, 'view_receipt'])->name('view_receipt');

Route::get('/cancel_receipt/{user_type}/{id}', [App\Http\Controllers\HomeController::class, 'cancel_receipt'])->name('cancel_receipt');

Route::get('/edit_company_details', [App\Http\Controllers\HomeController::class, 'edit_company_details'])->name('edit_company_details');

Route::post('/update_company_details', [App\Http\Controllers\HomeController::class, 'update_company_details'])->name('update_company_details');

Route::get('/receipt_pdf/{user_type}/{id}', [App\Http\Controllers\HomeController::class, 'receipt_pdf'])->name('receipt_pdf');

Route::post('/search_by_date', [App\Http\Controllers\HomeController::class, 'search_by_date'])->name('search_by_date');

Route::get('/cancel_list/{user_type?}', [App\Http\Controllers\HomeController::class, 'cancel_list'])->name('cancel_list');

Route::post('/search_cancel_receipts', [App\Http\Controllers\HomeController::class, 'search_cancel_receipts'])->name('search_cancel_receipts');

Route::get('/add_stock', [App\Http\Controllers\HomeController::class, 'add_stock'])->name('add_stock');

Route::post('/add_stock', [App\Http\Controllers\HomeController::class, 'create_stock'])->name('create_stock');

Route::get('/available_stock', [App\Http\Controllers\HomeController::class, 'available_stock'])->name('available_stock');

Route::get('edit_stock',[App\Http\Controllers\HomeController::class, 'edit_stock'])->name('edit_stock');

Route::post('update_stock/{id}',[App\Http\Controllers\HomeController::class, 'update_stock'])->name('update_stock');

Route::get('purchased_stock',[App\Http\Controllers\HomeController::class, 'purchased_stock'])->name('purchased_stock');

Route::get('change_password',[App\Http\Controllers\Auth\ResetPasswordController::class, 'change_password'])->name('change_password');

Route::post('change_password',[App\Http\Controllers\Auth\ResetPasswordController::class, 'update_password'])->name('update_password');

Route::get('sale_report',[App\Http\Controllers\HomeController::class, 'sale_report'])->name('sale_report');

Route::post('search_sale_report',[App\Http\Controllers\HomeController::class, 'sale_report'])->name('search_sale_report');

Route::post('report_export',[App\Http\Controllers\HomeController::class, 'report_export'])->name('report_export');

Route::get('general_report',[App\Http\Controllers\HomeController::class, 'general_report'])->name('general_report');

Route::get('expired',[App\Http\Controllers\HomeController::class, 'expired'])->name('expired');