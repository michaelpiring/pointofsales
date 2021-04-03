<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\DetailPembelian;
use App\Models\Produk;
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
        $data = Pembelian::all();
        return response()->json([
            'success' => true,
            'message' => 'Ini Index Pembelian',
            'data'    => $data
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
            $create_pembelian = Pembelian::create($data);
            if($create_pembelian){
                $data_produk = Produk::where('id_produk', $data['id_produk'])->first();

                $data_produk['stok'] = $data_produk['stok']+$data['jumlah_barang'];
                $update_stok = $data_produk->update([
                    'stok' => $data_produk['stok']
                ]);

                $create_detail_pembelian = DetailPembelian::create([
                    'id_pembelian' => $create_pembelian['id_pembelian'],
                    'tgl_pembelian' => now(),
                    'jumlah_barang' => $data['jumlah_barang'],
                    'total_pembelian' => $data['jumlah_barang'] * $data_produk['harga_produk'],
                    'id_toko' => $data['id_toko'],
                    'id_pegawai' => $data['id_pegawai'],
                    'id_produk' => $data['id_produk'],
                    'id_supplier' => $data['id_supplier']
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Menambahkan data Pembelian',
                    'data'    => $create_pembelian 
                ], 201);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DetailPembelian $detailpembelian)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Pembelian',
            'data'    => $detailpembelian
        ], 200);
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