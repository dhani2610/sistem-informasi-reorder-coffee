<?php

use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\DataSupplierController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReorderPointController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Models\BarangKeluar;
use Illuminate\Support\Facades\Auth;
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


Route::group(['middleware' => 'auth'], function () {

	Route::get('/', function () {
		if (Auth::user()) {
			return redirect('/login');
		}
	
	})->name('dashboard');

	Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

	Route::get('/data-barang', [DataBarangController::class, 'index'])->name('data-barang');
	Route::post('/tambah-data-barang', [DataBarangController::class, 'store'])->name('tambah-data-barang');
	Route::post('/update-data-barang/{id}', [DataBarangController::class, 'update'])->name('update-data-barang');
	Route::get('/delete-data-barang/{id}', [DataBarangController::class, 'destroy'])->name('delete-data-barang');
	

	Route::get('/data-supplier', [DataSupplierController::class, 'index'])->name('data-supplier');
	Route::post('/tambah-data-supplier', [DataSupplierController::class, 'store'])->name('tambah-data-supplier');
	Route::post('/update-data-supplier/{id}', [DataSupplierController::class, 'update'])->name('update-data-supplier');
	Route::get('/delete-data-supplier/{id}', [DataSupplierController::class, 'destroy'])->name('delete-data-supplier');
	

	Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('barang-masuk');
	Route::post('/tambah-barang-masuk', [BarangMasukController::class, 'store'])->name('tambah-barang-masuk');
	Route::post('/update-barang-masuk/{id}', [BarangMasukController::class, 'update'])->name('update-barang-masuk');
	Route::get('/delete-barang-masuk/{id}', [BarangMasukController::class, 'destroy'])->name('delete-barang-masuk');
	

	Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])->name('barang-keluar');
	Route::post('/tambah-barang-keluar', [BarangKeluarController::class, 'store'])->name('tambah-barang-keluar');
	Route::post('/update-barang-keluar/{id}', [BarangKeluarController::class, 'update'])->name('update-barang-keluar');
	Route::get('/delete-barang-keluar/{id}', [BarangKeluarController::class, 'destroy'])->name('delete-barang-keluar');
	

	Route::get('/reorder-point', [ReorderPointController::class, 'index'])->name('reorder-point');


    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-management', [InfoUserController::class, 'userManagement'])->name('user-management');
	Route::post('/tambah-user', [InfoUserController::class, 'tambahUser'])->name('tambah-user');
	Route::post('/update-user/{id}', [InfoUserController::class, 'updateUser'])->name('update-user');
	Route::get('/delete-user/{id}', [InfoUserController::class, 'deleteUser'])->name('delete-user');
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');
});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/login-post', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');