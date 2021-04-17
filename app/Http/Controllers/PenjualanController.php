<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use App\Models\Checkout;
use App\Models\Keranjang;
use App\Models\DetailKeranjang;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Http\Requests\Penjualan\CreatePenjualanRequest;

use Carbon\Carbon;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Penjualan::all();
        if($data){
            return response()->json([
                'success' => true,
                'message' => 'Index Data Penjualan',
                'data'    => $data
            ], 201);
        }
        return response()->json([
            'success' => false,
            'message' => 'Data Kosong!',
        ], 404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePenjualanRequest $request)
    {
        $data = $request->validated();
        if($data){
            //data berhasil divalidasi

            //ambil data yang diperlukan
            $data_checkout = Checkout::where('id_checkout', $data['id_checkout'])->first();
            $data_keranjang = Keranjang::where('id_keranjang', $data_checkout['id_keranjang'])->first();
            $data_user = User::where('id', $data_checkout['id_user'])->first();

            //cek metode pembayaran
            if($data['metode_pembayaran']=="cash"){
                //create data penjualan
                $data['id_user'] = $data_user['id'];
                $data['tgl_penjualan'] = now();
                $data['total_penjualan'] = $data_checkout['total_checkout'];
                $data['status'] = 'sudah dibayar';

                $create_penjualan = Penjualan::create($data);

                if($create_penjualan){
                    //create detail penjualan & kurangin stok barang di tb produk
                    $data_detail_keranjangs = DetailKeranjang::where('id_keranjang', $data_keranjang['id_keranjang'])->get();

                    foreach($data_detail_keranjangs as $data_detail_keranjang){
                        DetailPenjualan::create([
                            'id_penjualan'  => $create_penjualan['id_penjualan'],
                            'id_toko'       => $create_penjualan['id_toko'],
                            'id_user'       => $create_penjualan['id_user'],
                            'id_pegawai'    => $create_penjualan['id_pegawai'],
                            'id_produk'     => $data_detail_keranjang['id_produk'],
                            'tgl_penjualan' => now(),
                            'jumlah_produk' => $data_detail_keranjang['jumlah_produk'],
                            'total_harga'   => $data_detail_keranjang['total_harga']
                        ]);

                        //update stok di tb produk
                        $data_produk = Produk::where('id_produk', $data_detail_keranjang['id_produk'])->first();

                        $kurangi_stok = $data_produk['stok'] - $data_detail_keranjang['jumlah_produk'];
                        $update_stok = Produk::where('id_produk', $data_detail_keranjang['id_produk'])->update([
                            'stok' => $kurangi_stok
                        ]);
                    }
                    $update_status_checkout = Checkout::where('id_checkout', $data['id_checkout'])->update([
                        'status' => 'sudah dibayar'
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Transaksi Berhasil!',
                        'data'    => $data 
                    ], 201);
                }
            }

            if($data['metode_pembayaran']=="hutang"){
                //create data penjualan & hutang
            }

            if($data['metode_pembayaran']=="split"){
                //create data penjualan & hutang (split payment)
            }

        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Data tidak Valid!',
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
