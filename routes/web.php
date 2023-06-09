<?php


use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\DataPelangganController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\TambahAdminController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\TransaksiController;
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
	return redirect('/dashboard');
})->middleware('auth');

//Route Tanpa Harus Login
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');

//
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::post('/profilePassword', [UserProfileController::class, 'updatePassword'])->name('password.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware('auth')->group(function () {
	// Route Produk
	Route::controller(ProdukController::class)->prefix('produk')->group(function () {
		Route::get('', 'index')->name('keProduk');
		Route::get('tambah', 'tambah')->name('produk.tambah');
		Route::post('tambah', 'simpan')->name('produk.tambah.simpan');
		Route::get('/produk/{id}/edit', 'edit')->name('produk.edit');
		Route::put('/produk/{id}', 'update')->name('produk.update');
		Route::delete('/produk/{id}', 'hapus')->name('produk.hapus');
	});
	// Route Data Admin
	Route::controller(UsersController::class)->prefix('admin')->group(function () {
		Route::get('', 'index')->name('keUsers');
		Route::get('edit/{id}', 'edit')->name('admin.edit');
		Route::post('edit/{id}', 'update')->name('admin.tambah.update');
		Route::delete('hapus/{id}', 'hapus')->name('admin.hapus');
	});
	//route Tambah admin
	Route::controller(TambahAdminController::class)->prefix('TambahAdmin')->group(function () {
		Route::get('', 'index')->name('keTambahAdmin');
		Route::get('/admin/add', 'create')->name('admin.add');
		Route::post('/admin/store', 'store')->name('admin.store');
	});
	//route Riwayat
	Route::controller(RiwayatController::class)->prefix('Riwayat')->group(function () {
		Route::get('', 'index')->name('keRiwayat');
		Route::get('hapus/{id}', 'hapus')->name('riwayat.hapus');
		route::get('lihat/{id}', 'pdf')->name('export-pdf');
		route::get('riwayat/export/', 'export')->name('export-excel');
	});
	//route Transaksi
	Route::controller(TransaksiController::class)->prefix('Transaksi')->group(function () {
		Route::get('', 'index')->name('keTransaksi');
		Route::get('tambah', 'tambah')->name('transaksi.tambah');
		Route::post('tambah', 'simpan')->name('transaksi.tambah.simpan');
		Route::put('edit/{id}', 'edit')->name('transaksi.edit');
		Route::post('edit/{id}', 'update')->name('transaksi.tambah.update');
		Route::put('ubah/{id}', 'ubah')->name('ubah.produk');
		Route::delete('hapus/{id}', 'hapus')->name('transaksi.hapus');
	});
	// Route Data Pelanggan
	Route::controller(DataPelangganController::class)->prefix('pelanggan')->group(function () {
		Route::get('', 'index')->name('kePelanggan');
		Route::put('edit/{id}', 'edit')->name('pelanggan.edit');
		Route::post('edit/{id}', 'update')->name('pelanggan.tambah.update');
		Route::delete('hapus/{id}', 'hapus')->name('pelanggan.hapus');
	});
});
