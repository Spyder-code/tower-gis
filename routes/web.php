<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\Pagecontroller;
use App\Http\Controllers\PemilikController;
use App\Http\Controllers\TowerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Kecamatan;
use App\Models\Pemilik;
use App\Models\Tower;
use Database\Seeders\KecamatanSeeder;
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
    Route::get('map/filter',[AdminController::class,'mapFilter'])->name('map.filter');
    Route::get('profile',[AdminController::class,'profile'])->name('profile');
    Route::resource('tower', TowerController::class);
    Route::resource('user', UserController::class);
    Route::resource('pemilik', PemilikController::class);
    Route::resource('kecamatan', KecamatanController::class);
    Route::put('changePassword/{user}', [UserController::class,'updatePassword'])->name('user.update.password');
    Route::resource('transaksi', TransactionController::class);
    Route::get('transaksi/tulis/{transaksi}', [TransactionController::class, 'tulis'])->name('transaksi.tulis');
    Route::get('dataKecamatan', [TowerController::class,'kecamatan']);
    Route::get('data',[AdminController::class,'data'])->name('data');
    Route::get('transaction',[AdminController::class,'transaction'])->name('transaction');
    Route::get('transactionCreate',[AdminController::class,'transactionCreate'])->name('transaction.create');
});

Route::get('/',[Pagecontroller::class,'index'])->name('home');
Route::post('/filter',[Pagecontroller::class,'filter'])->name('filter');
//Route::get('/filter',[Pagecontroller::class,'filter'])->name('filter');

require __DIR__.'/auth.php';
