<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\DetailStokOpname;
use App\Models\DetailStokOpnameSementara;
use App\Models\StokOpname;
use App\Models\Pembelian;
class StokOpnameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'id_pegawai' => 'required'
        ]);
        if($validate){
            $stok_opname = StokOpname::orderBy('tgl_stok_opname', 'desc')->first();
            $data = StokOpname::create([
                'id_pegawai' => $request->id_pegawai,
                'tgl_stok_opname' => now()
            ]);
            $data['stok_opname_terakhir'] = $stok_opname['tgl_stok_opname'];
            return response()->json([
                'success' => true,
                'message' => 'Sukses store data',
                'data' => $data
            ], 201);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'gagal store stok opname',
            ], 400);
        }
    }
    // ini buat nyimpen data stokopname sementar
    // request berupa id stok opname, id produk, stok fisik dan stok opname terakhir
    // 
    public function stokOpnameProdukSementara(Request $request){
        $validate = $request->validate([
            'id_stok_opname' => 'required',
            'id_produk' => 'required',
            'stok_fisik' => 'required|numeric',
            'stok_opname_terakhir' => 'required'
        ]);
        if($validate){
            $stokOpname = StokOpname::where('id_stok_opname', $validate['id_stok_opname'])->first();
            $produk = Produk::where('id_produk', $validate['id_produk'])->first();
            $penjualan = 
            $data = DetailStokOpnameSementara::create([
                'id_stok_opname' => 
            ])
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
