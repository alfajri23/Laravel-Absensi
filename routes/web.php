<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\LiburController;

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

Route::middleware('auth')->group(function () {

	Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
	

	Route::prefix('user')->group(function(){
		Route::get('histori',[UserController::class,'history'])->name('userJadwal');
		Route::get('/mount', [App\Http\Controllers\HomeController::class, 'getMount'])->name('getMount');
	});

	Route::prefix('admin')->group(function(){
		Route::get('/user',[UserController::class,'index'])->name('userAll');
		Route::post('/user/get',[UserController::class,'getOne'])->name('userOne');
		Route::post('/user/edit',[UserController::class,'edit'])->name('userEdit');

		Route::get('/jadwal',[JadwalController::class,'index'])->name('jadwalAll');
		Route::post('/jadwal/create',[JadwalController::class,'store'])->name('jadwalStore');
		Route::get('/jadwal/{ids}/{id}',[JadwalController::class,'getUser'])->name('jadwalUser');

		Route::get('/libur',[LiburController::class,'index'])->name('liburAll');
		Route::post('/libur/get',[LiburController::class,'show'])->name('liburOne');
		Route::post('/libur/create',[LiburController::class,'store'])->name('liburStore');
		Route::post('/libur/delete',[LiburController::class,'delete'])->name('liburDelete');
	});

	Route::prefix('absen')->group(function(){
		Route::post('/',[AbsensiController::class,'store'])->name('saveAbsensi');
		Route::post('/detail',[AbsensiController::class,'detail'])->name('detailAbsensi');
	});
	


	Route::post('/absen',[AbsensiController::class,'store'])->name('saveAbsensi');
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

