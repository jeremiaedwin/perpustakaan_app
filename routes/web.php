<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataBukuController;
use App\Http\Controllers\AnggotaController;

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

Auth::routes();

Route::resource('users', \App\Http\Controllers\UserController::class)
    ->middleware('auth');
Route::group(['middleware' => ['role:admin']], function () {
    Route::resource('peminjaman', \App\Http\Controllers\PeminjamanController::class)->middleware('auth');
    Route::resource('pengembalian', \App\Http\Controllers\PengembalianController::class)->middleware('auth');
    Route::resource('anggota', \App\Http\Controllers\AnggotaController::class);
    Route::get('/anggota/search/{id}', [AnggotaController::class, 'search']);
    Route::get('/buku/search/{id}', [DataBukuController::class, 'search']);
    Route::get('/data_buku', [DataBukuController::class, 'index']);
    Route::get('/data_buku/create', [DataBukuController::class, 'create']);
    Route::post('/data_buku', [DataBukuController::class, 'store']);
    Route::get('/data_buku/{id}/edit', [DataBukuController::class, 'edit']);
    Route::put('/data_buku/{id}', [DataBukuController::class, 'update']);
    Route::delete('/data_buku/{id}', [DataBukuController::class, 'destroy']);
});

Route::group(['middleware' => ['role:anggota']], function () {
    Route::get('/riwayat-peminjaman', [App\Http\Controllers\RekapController::class, 'RekapRiwayatPeminjaman']);
});
    

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
	
Route::get('/rekap', [App\Http\Controllers\RekapController::class, 'makeRekap']);
