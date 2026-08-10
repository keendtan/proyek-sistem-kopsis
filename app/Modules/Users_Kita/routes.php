<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Users_kita\Controllers\Users_kitaController;

Route::controller(Users_kitaController::class)->middleware(['web','auth'])->name('users_kita.')->group(function(){
	Route::get('/users_kita', 'index')->name('index');
	Route::get('/users_kita/data', 'data')->name('data.index');
	Route::get('/users_kita/create', 'create')->name('create');
	Route::post('/users_kita', 'store')->name('store');
	Route::get('/users_kita/{users_kita}', 'show')->name('show');
	Route::get('/users_kita/{users_kita}/edit', 'edit')->name('edit');
	Route::patch('/users_kita/{users_kita}', 'update')->name('update');
	Route::get('/users_kita/{users_kita}/delete', 'destroy')->name('destroy');
});
