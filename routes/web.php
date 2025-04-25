<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/customer/trash', [CustomerController::class, 'trash'])->name('customer.trash');
Route::resource('customer', CustomerController::class);
