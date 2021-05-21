<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\Pembelian\CreatePembelianRequest;

use Carbon\Carbon;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembelian = Pembelian::all();

        $datas = $pembelian->sortBy('tgl_pembelian');

        foreach($datas as $data){
            $data_produk_show = Produk::where('id_produk', $data['id_produk'])->first();
            $data_supplier = Supplier::where('id_supplier', $data['id_supplier'])->first();

            $data['nama_produk'] = $data_produk_show['nama_produk'];
            $data['nama_supplier'] = $data_supplier['nama_supplier'];
        }
        return response()->json([
            'success' => true,
            'message' => 'Ini Index Pembelian',
            'data'    => $datas
        ], 201);
    }

    public function indexPembelianPending()
    {
        $pembelians = Pembelian::where('status','pending')->get();

        $datas = $pembelians->sortBy('tgl_pembelian');

        foreach($datas as $data){
            $data_produk_show = Produk::where('id_produk', $data['id_produk'])->first();
            $data_supplier = Supplier::where('id_supplier', $data['id_supplier'])->first();

            $data['nama_produk'] = $data_produk_show['nama_produk'];
            $data['nama_supplier'] = $data_supplier['nama_supplier'];
        }
        return response()->json([
            'success' => true,
            'message' => 'Ini Index Pembelian',
            'data'    => $datas
        ], 201);
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
    public function store(CreatePembelianRequest $request)
    {
        $data = $request->validated();
        if(!$data){
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan data Pembelian, Data tidak Valid!',
            ], 404);
        }
        else{
            $data['tgl_pembelian'] = now();
            $data['total_pembelian'] = $data['jumlah_barang']*$data['harga_beli'];
            $data['status'] = 'pending';
            $create_pembelian = Pembelian::create($data);
            if($create_pembelian){
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Menambahkan data Pembelian',
                    'data'    => $create_pembelian 
                ], 201);
            }
        }
    }

    public function ValidasiPembelian(Pembelian $pembelian)
    {
        if($pembelian['status']!='success'){ 
            //status pending
            $data_produk = Produk::where('id_produk', $pembelian['id_produk'])->first();
            $data_pembelian = Pembelian::where('id_pembelian', $pembelian['id_pembelian'])->first();

            $data_produk['stok'] = $data_produk['stok']+$data_pembelian['jumlah_barang'];
            $update_produk = $data_produk->update([
                'stok' => $data_produk['stok'],
                'harga_beli' => $data_pembelian['harga_beli']
            ]);
            if($update_produk){
                $pembelian->update([
                    'status'=>'success'
                ]);

                $pembelian['stok masuk'] = $data_pembelian['jumlah_barang'];
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil validasi Pembelian, Stok ditambahkan',
                    'data'    => $pembelian
                ], 200);
            }            
        }
        if($pembelian['status']!='pending'){ //status success
            return response()->json([
                'success' => true,
                'message' => 'Data Pembelian telah divalidasi!',
                'data'    => $pembelian
            ], 409);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal validasi Data Pembelian',
            ], 409);
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
        if($id){
            $data = Pembelian::where('id_pembelian', $id)->first();
            $data_produk_show = Produk::where('id_produk', $data['id_produk'])->first();
            $data_supplier = Supplier::where('id_supplier', $data['id_supplier'])->first();

            $data['nama_produk'] = $data_produk_show['nama_produk'];
            $data['nama_supplier'] = $data_supplier['nama_supplier'];

            return response()->json([
                'success' => true,
                'message' => 'Detail Data Pembelian',
                'data'    => $data
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal Dalam Menampilkan Data Detail Pembelian',
            ], 409);
        }
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
