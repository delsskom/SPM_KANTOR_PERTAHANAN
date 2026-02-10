<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpmController;

/*
|--------------------------------------------------------------------------
| ROUTE UMUM
|--------------------------------------------------------------------------
*/

Route::get('/', [SpmController::class, 'welcome'])->name('home');

Route::view('/welcome', 'welcome')->name('welcome');
Route::view('/tentang', 'tentang')->name('tentang');

/*
|--------------------------------------------------------------------------
| ROUTE SPM (CRUD LENGKAP)
|--------------------------------------------------------------------------
*/

Route::resource('spm', SpmController::class);

Route::resource('spm', SpmController::class)->except('show');

