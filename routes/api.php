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

//route user
//update pembelian

Route::group([
    'middleware' => 'auth:user'

], function ($router) {

    
});

// route user dan pegawai


//route pegawai

Route::group([
    'middleware' => 'auth:pegawai'

], function ($router) {

    Route::put('toko/{toko}/aktivasi_toko', [TokoController::class,'aktivasiToko']);
    Route::apiResource('supplier', SupplierController::class);
    Route::put('supplier/{supplier}/aktivasi_supplier', [SupplierController::class,'aktivasiSupplier']);
    
    Route::apiResource('kategori', KategoriController::class);
    Route::put('kategori/{kategori}/aktivasi_kategori', [KategoriController::class,'aktivasiKategori']);
    
    Route::put('produk/{produk}/aktivasi_produk', [ProdukController::class,'aktivasiProduk']);

    
    Route::put('user/{user}/aktivasi_user', [UserController::class,'aktivasiUser']);
    Route::post('/user/getUser', [UserController::class,'showUser']);
    
    Route::put('pegawai/{pegawai}/aktivasi_pegawai', [PegawaiController::class,'aktivasiPegawai']);
    
    Route::apiResource('pembelian', PembelianController::class);
    Route::put('pembelian/{pembelian}/ValidasiPembelian', [PembelianController::class,'ValidasiPembelian']);
    Route::get('/getPembelianPending', [PembelianController::class,'indexPembelianPending']);
    
    Route::apiResource('retur', ReturController::class);
    Route::put('retur/{retur}/validasiRetur', [ReturController::class,'validasiRetur']);

    
    Route::apiResource('stok-opname', StokOpnameController::class);
    Route::post('stok-opname/getDetailProductForStockOpname', [StokOpnameController::class,'getDetailProductForStockOpname']);
    Route::post('stok-opname/storeStokOpname', [StokOpnameController::class,'storeStokOpname']);
    Route::put('stok-opname/{stok-opname}/approveStokOpname', [StokOpnameController::class,'approveStokOpname']);
    Route::put('stok-opname/{stok-opname}/unapprove', [StokOpnameController::class,'unapproveStokOpname']);
});

Route::apiResource('keranjang', KeranjangController::class);
Route::apiResource('checkout', CheckoutController::class);
Route::apiResource('penjualan', PenjualanController::class);
Route::apiResource('hutang', PembayaranHutangController::class);
Route::get('/indexHutang_user/{id}',[PembayaranHutangController::class, 'indexHutangUser']);

Route::apiResource('produk', ProdukController::class);
Route::apiResource('toko', TokoController::class);
Route::apiResource('promo-diskon', PromoDiskonController::class);
Route::apiResource('promo-produk', PromoProdukController::class);

Route::apiResource('pegawai', PegawaiController::class);
Route::put('pegawai/{pegawai}/ganti_password', [PegawaiController::class,'changePassword']);

Route::apiResource('user', UserController::class);
Route::apiResource('promo-produk', PromoProdukController::class);

Route::put('user/{user}/ganti_password_user', [UserController::class,'changePasswordUser']);

Route::get('/history_transaksi_user/{id}',[PenjualanController::class, 'historyTransaksiUser']);

Route::post('/produk/showByBarcode', [ProdukController::class,'showByBarcode']);

Route::post('/penjualan/detailProdukDataPenjualan', [PenjualanController::class,'detailProdukDataPenjualan']);

Route::apiResource('report', ReportController::class);
Route::post('/report/purchase', [ReportController::class, 'purchaseChart']);
Route::post('/report/sales', [ReportController::class, 'salesChart']);
Route::post('/report/SalesCategorySummary', [ReportController::class, 'SalesCategorySummary']);
Route::post('/report/PurchaseCategorySummary', [ReportController::class, 'PurchaseCategorySummary']);
Route::get('/report',[ReportController::class, 'index']);

//app kasir
Route::apiResource('loginpegawai', LoginController::class);
//

Route::post('/login', [AuthController::class, 'login']);
Route::post('/login_pegawai', [AuthController::class, 'loginPegawai']);
Route::post('/register_user', [AuthController::class, 'registerUser']);
Route::post('/register_pegawai', [AuthController::class, 'registerPegawai']);

Route::group([
    'middleware' => 'auth:pegawai,user'

], function ($router) {
    
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/profile', [AuthController::class, 'profile']);    
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

