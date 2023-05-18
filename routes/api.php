<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\DataPelangganController;
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

Route::put('/customers/{id}', [DataPelangganController::class, 'update'])->name('customers.update');
Route::get('/customers', [DataPelangganController::class, 'index']);
