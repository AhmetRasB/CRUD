<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/customer/trash', [CustomerController::class, 'trash'])->name('customer.trash');
Route::get('/customer/restore/{customers}', [CustomerController::class, 'restore'])->name('customer.restore');
Route::delete('/customer/trash/{customers}', [CustomerController::class, 'forceDelete'])->name('customer.forceDelete');


Route::resource('customer', CustomerController::class);
