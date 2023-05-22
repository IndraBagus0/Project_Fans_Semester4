<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('customers-with-product', [ApiController::class, 'getCustomersWithProduct']);
Route::post('/login', [ApiController::class, 'login']);
Route::post('/transaction', [ApiController::class, 'transaction']);
Route::post('/transactionUp', [ApiController::class, 'updateTransaction']);
Route::post('/register', [ApiController::class, 'register']);
Route::get('/products', [ApiController::class, 'Produk']);
Route::post('/loginPelanggan', [ApiController::class, 'LoginPelanggan']);
Route::get('/riwayat', [ApiController::class, 'getRiwayat']);
Route::post('/updateProfil', [ApiController::class, 'updateProfil']);
Route::post('/updatePassword', [ApiController::class, 'updatePassword']);
Route::post('/tes', [ApiController::class, 'store']);