<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard',[AdminController::class,'index'])->name('dashboard');
    Route::get('profile',[AdminController::class,'profile'])->name('profile');
    Route::get('tower',[AdminController::class,'tower'])->name('tower');
    Route::get('user',[AdminController::class,'user'])->name('user');
    Route::get('opd',[AdminController::class,'opd'])->name('opd');
    Route::get('transaction',[AdminController::class,'transaction'])->name('transaction');
});

require __DIR__.'/auth.php';
