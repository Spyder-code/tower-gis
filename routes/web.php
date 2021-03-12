<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Pagecontroller;
use App\Http\Controllers\TowerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard',[AdminController::class,'index'])->name('dashboard');
    Route::get('profile',[AdminController::class,'profile'])->name('profile');
    Route::resource('tower', TowerController::class);
    Route::resource('user', UserController::class);
    Route::resource('transaksi', TransactionController::class);
    Route::get('transaksi/tulis/{transaksi}', [TransactionController::class, 'tulis'])->name('transaksi.tulis');
    Route::get('dataKecamatan', [TowerController::class,'kecamatan']);
    Route::get('opd',[AdminController::class,'opd'])->name('opd');
    Route::get('transaction',[AdminController::class,'transaction'])->name('transaction');
});

Route::get('/',[Pagecontroller::class,'index'])->name('home');

require __DIR__.'/auth.php';
