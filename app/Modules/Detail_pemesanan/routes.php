<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Detail_pemesanan\Controllers\Detail_pemesananController;

Route::controller(Detail_pemesananController::class)->middleware(['web','auth'])->name('detail_pemesanan.')->group(function(){
	Route::get('/detail_pemesanan', 'index')->name('index');
	Route::get('/detail_pemesanan/data', 'data')->name('data.index');
	Route::get('/detail_pemesanan/create', 'create')->name('create');
	Route::post('/detail_pemesanan', 'store')->name('store');
	Route::get('/detail_pemesanan/{detail_pemesanan}', 'show')->name('show');
	Route::get('/detail_pemesanan/{detail_pemesanan}/edit', 'edit')->name('edit');
	Route::patch('/detail_pemesanan/{detail_pemesanan}', 'update')->name('update');
	Route::get('/detail_pemesanan/{detail_pemesanan}/delete', 'destroy')->name('destroy');
});
