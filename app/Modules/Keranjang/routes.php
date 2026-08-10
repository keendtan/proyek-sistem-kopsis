<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Keranjang\Controllers\KeranjangController;

Route::controller(KeranjangController::class)->middleware(['web','auth'])->name('keranjang.')->group(function(){
	Route::get('/keranjang', 'index')->name('index');
	Route::get('/keranjang/data', 'data')->name('data.index');
	Route::get('/keranjang/create', 'create')->name('create');
	Route::post('/keranjang', 'store')->name('store');
	Route::get('/keranjang/{keranjang}', 'show')->name('show');
	Route::get('/keranjang/{keranjang}/edit', 'edit')->name('edit');
	Route::patch('/keranjang/{keranjang}', 'update')->name('update');
	Route::get('/keranjang/{keranjang}/delete', 'destroy')->name('destroy');
});
