<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataBukuController;
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

    Route::resource('peminjaman', \App\Http\Controllers\PeminjamanController::class)->middleware('auth');;
    Route::resource('anggota', \App\Http\Controllers\AnggotaController::class);
    Route::get('/data_buku', [DataBukuController::class, 'index']);
    Route::get('/data_buku/create', [DataBukuController::class, 'create']);
    Route::post('/data_buku', [DataBukuController::class, 'store']);
    Route::get('/data_buku/{id}/edit', [DataBukuController::class, 'edit']);
    Route::put('/data_buku/{id}', [DataBukuController::class, 'update']);
    Route::delete('/data_buku/{id}', [DataBukuController::class, 'destroy']);

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
	
Route::get('/rekap', [App\Http\Controllers\RekapController::class, 'makeRekap']);