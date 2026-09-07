<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Keranjang\Controllers\KeranjangController;

Route::controller(KeranjangController::class)->middleware(['web','auth'])->name('keranjang.')->group(function(){
	Route::get('/keranjang', 'index')->name('index');
	Route::post('/keranjang', 'store')->name('store');
	Route::post('/keranjang/checkout', 'checkout')->name('checkout');
});
