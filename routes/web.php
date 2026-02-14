<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpmController;

/*
|--------------------------------------------------------------------------
| ROUTE UMUM
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('/welcome', 'welcome')->name('welcome');
Route::view('/tentang', 'tentang')->name('tentang');

/*
|--------------------------------------------------------------------------
| ROUTE SPM (HANYA ADMIN)
|--------------------------------------------------------------------------
*/

// Batasi akses route spm hanya untuk yang sudah login dan punya role admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('spm', SpmController::class);
});

/*
|--------------------------------------------------------------------------
| ROUTE DASHBOARD (BREEZE)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return redirect()->route('spm.index');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| ROUTE PROFILE (BREEZE)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
