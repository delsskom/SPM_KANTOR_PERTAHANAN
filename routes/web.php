<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpmController;

Route::get('/', [SpmController::class, 'welcome'])->name('home');


Route::get('/welcome', [SpmController::class, 'welcome'])->name('welcome');

Route::view('/', 'welcome');
Route::view('/tentang', 'tentang');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');


Route::get('/spm', [SpmController::class, 'index'])->name('spm.index');
Route::get('/spm/create', [SpmController::class, 'create'])->name('spm.create');
Route::post('/spm/store', [SpmController::class, 'store'])->name('spm.store');
