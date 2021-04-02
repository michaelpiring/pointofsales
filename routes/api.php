<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::apiResource('toko', TokoController::class);
Route::apiResource('supplier', SupplierController::class);
Route::apiResource('promo-diskon', PromoDiskonController::class);
Route::apiResource('kategori', KategoriController::class);



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login_user', [AuthController::class, 'loginUser']);
    Route::post('/register_user', [AuthController::class, 'registerUser']);
    Route::post('/logout_user', [AuthController::class, 'logoutUser']);
    Route::post('/refresh_user', [AuthController::class, 'refreshUser']);
    Route::get('/profile_user', [AuthController::class, 'profileUser']);    
});

/*
Route::group(['prefix' => 'pegawai','middleware' => ['assign.guard:pegawai','jwt.auth']],function ()
{
    Route::post('/login_pegawai', [AuthController::class, 'loginPegawai']);
    Route::post('/register_pegawai', [AuthController::class, 'registerPegawai']);
    Route::post('/logout_pegawai', [AuthController::class, 'logoutPegawai']);
    Route::post('/refresh_pegawai', [AuthController::class, 'refreshPegawai']);
    Route::get('/profile_pegawai', [AuthController::class, 'profilePegawai']);
	Route::get('/demo','SubadminController@demo');	
});
*/

