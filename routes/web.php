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
| ROUTE SPM (CRUD LENGKAP + TERLIHAT SEMUA)
|--------------------------------------------------------------------------
*/

Route::prefix('spm')->name('spm.')->group(function () {

    Route::get('/', [SpmController::class, 'index'])->name('index');
    Route::get('/create', [SpmController::class, 'create'])->name('create');
    Route::post('/', [SpmController::class, 'store'])->name('store');

    Route::get('/{id}/edit', [SpmController::class, 'edit'])->name('edit');
    Route::put('/{id}', [SpmController::class, 'update'])->name('update');

    Route::delete('/{id}', [SpmController::class, 'destroy'])->name('destroy');

});
