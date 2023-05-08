<?php


use App\Http\Controllers\ChangePassword;
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
Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
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
		Route::get('edit/{id}', 'edit')->name('produk.edit');
		Route::post('edit/{id}', 'update')->name('produk.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('produk.hapus');
	});
	// Route Data Admin
	Route::controller(UsersController::class)->prefix('admin')->group(function () {
		Route::get('', 'index')->name('keUsers');
		Route::get('edit/{id}', 'edit')->name('admin.edit');
		Route::post('edit/{id}', 'update')->name('admin.tambah.update');
		Route::get('hapus/{id}', 'hapus')->name('admin.hapus');
	});
	//route Tambah admin
	Route::controller(TambahAdminController::class)->prefix('TambahAdmin')->group(function () {
		Route::get('', 'index')->name('keTambahAdmin');
		Route::get('tambah', 'tambah')->name('admin.tambah');
		Route::post('tambah', 'simpan')->name('admin.tambah.simpan');
	});
	//route Riwayat
	Route::controller(RiwayatController::class)->prefix('Riwayat')->group(function () {
		Route::get('', 'index')->name('keRiwayat');
		Route::get('tambah', 'tambah')->name('riwayat.tambah');
		Route::post('tambah', 'simpan')->name('riwayat.tambah.simpan');
	});
	//route Transaksi
	Route::controller(TransaksiController::class)->prefix('Transaksi')->group(function () {
		Route::get('', 'index')->name('keTransaksi');
		Route::get('tambah', 'tambah')->name('transaksi.tambah');
		Route::post('tambah', 'simpan')->name('transaksi.tambah.simpan');
	});
});


// git config user.name "indrabagus0"
//git config user.email "indrabusiness00@gmail.com"