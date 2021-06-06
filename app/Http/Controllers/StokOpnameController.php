<?php

// INGET DI PRODUKNYA ITU NANTI KASI ID TOKO
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\DetailPenjualan;
use App\Models\DetailPembelian;
use App\Models\DetailStokOpname;
use App\Models\DetailStokOpnameSementara;
use App\Models\StokOpname;
use App\Models\Pembelian;
use GrahamCampbell\ResultType\Success;
use Illuminate\Auth\Events\Validated;

class StokOpnameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = StokOpname::where('status', '!=', 'unapproved')->where('status','!=','canceled')->where('status','!=','on progress')->get();
        if($data){
            return response()->json([
                'success' => true,
                'data' => $data
            ],201);
        }
        else{
            return response()->json([
                'success' => false,
            ],401);
        }
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
            'id_toko' => 'required',
            'id_pegawai' => 'required'
        ]);
        if($validate){
            $stok_opname = StokOpname::where('status', 'approved')->orderBy('tgl_stok_opname', 'desc')->first();
            $data = StokOpname::create([
                'id_toko' => $request->id_toko,
                'id_pegawai' => $request->id_pegawai,
                'tgl_stok_opname' => now(),
                'status' => 'on progress'
            ]);
            if(!$stok_opname){
                $data['stok_opname_terakhir'] = date('2018-01-01');
            }else{
                $data['stok_opname_terakhir'] = $stok_opname['tgl_stok_opname'];
            }
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
    public function getDetailProductForStockOpname(Request $request){
        $validate = $request->validate([
            'id_toko' => 'required',
            'id_stok_opname' => 'required',
            'id_produk' => 'required',
            'stok_fisik' => 'required|numeric',
            'stok_opname_terakhir' => 'required',
            'keterangan' => 'required'
        ]);
        if($validate){            
            $produk = Produk::where([['id_produk', $validate['id_produk']]])->first();
            $penjualan = DetailPenjualan::where('id_toko',$validate['id_toko'])
                                        ->where('id_produk',$validate['id_produk'])->whereBetween('tgl_penjualan', [$validate['stok_opname_terakhir'], now()])->sum('jumlah_produk');
            $pembelian = Pembelian::where([['id_toko', $validate['id_toko']],
                                            ['id_produk', $validate['id_produk']]])->whereBetween('tgl_pembelian',[$validate['stok_opname_terakhir'], now()])->sum('jumlah_barang'); 
        
            if($produk){
                $data = ([
                    'id_stok_opname' => $request->id_stok_opname,
                    'id_produk' => $request->id_produk,
                    'nama_produk' => $produk['nama_produk'],
                    'stok_masuk' => $penjualan,
                    'stok_keluar' => $pembelian,
                    'stok_sistem' => $produk['stok'],
                    'stok_fisik' => $request->stok_fisik,
                    'selisih' => $request->stok_fisik - $produk['stok'],
                    'keterangan' => $request->keterangan
                ]);
                return response()->json([
                    'success' => true,
                    'data' => $data,
                    'penjualan' => $penjualan,
                    'pembelian' => $pembelian
                ]);
            }
            else{
                return response()->json([
                    'success' => false
                ]);
            }                                     
        }
    }

    public function storeStokOpname(Request $request){
        $validate = $request->validate([
            'id_toko' => 'required',
            'id_stok_opname' => 'required'
        ]);
        $data = $request->datas;
        if($validate){
            $stok_opname = StokOpname::where('id_stok_opname', $validate['id_stok_opname']);
            if($data){
                foreach($data as $data){
                    DetailStokOpname::create([
                        'id_stok_opname' => $request->id_stok_opname,
                        'id_produk' => $data['id_produk'],
                        'stok_masuk' => $data['stok_masuk'],
                        'stok_keluar' => $data['stok_keluar'],
                        'stok_sistem' => $data['stok_sistem'],
                        'stok_fisik' => $data['stok_fisik'],
                        'selisih' => $data['selisih'],
                        'keterangan' => $data['keterangan']
                    ]);
                }
                $stok_opname->update([
                    'status' => 'pending validation'
                ]);
                return response()->json([
                    'success' => true,
                ],201);

            }
            else{
                return response()->json([
                    'success' => false
                ],400);
            }
        }
        else{
            return response()->json([
                'success' => false,
                'data' => $data
            ],400);
        }
    }
    public function approveStokOpname($id){
        $cek_user = auth()->user();

        $data = StokOpname::where('id_stok_opname', $id)->first();
        if($data){
            if($cek_user['id_jabatan'] == '2'){
                $data->update(['status' => 'approved']);
                return response()->json([
                    'success' => true
                ],201);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi Pembelian hanya dapat dilakukan Kepala Gudang!',
                ], 409);
            }
        }else{
            return response()->json([
                'success' => false,
                'id' => $id,
                'data' => $data
            ],401);
        }
    }

    public function unapproveStokOpname($id){
        $cek_user = auth()->user();

        $data = StokOpname::where('id_stok_opname', $id)->first();
        if($data){
            if($cek_user['id_jabatan'] == '2'){
                $data->update(['status' => 'unapproved']);
                return response()->json([
                    'success' => true
                ],201);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi Pembelian hanya dapat dilakukan Kepala Gudang!',
                ], 409);
            }
        }else{
            return response()->json([
                'success' => false,
                'id' => $id,
                'data' => $data
            ],401);
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
        $data = DetailStokOpname::where('id_stok_opname',$id)->get();
        if($data){
            foreach($data as $d){
                $data_produk_show = Produk::where('id_produk', $d['id_produk'])->first();
                $d['nama_produk'] = $data_produk_show['nama_produk'];
            }
            $dataStockOpname = StokOpname::where('id_stok_opname',$id)->get();

            return response()->json([
                'success' => true,
                'data' => $data,
                'stock_opname' => $dataStockOpname
            ],201);
        }else{
            return response()->json([
                'success' => false,
            ],401);
        }
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
        $cek_user = auth()->user();

        $data = StokOpname::where('id_stok_opname', $id)->first();
        if($data){
            if($cek_user['id_jabatan'] == '2'){
                $data->update(['status' => 'approved']);
                return response()->json([
                    'success' => true
                ],201);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi Pembelian hanya dapat dilakukan Kepala Gudang!',
                ], 409);
            }
        }else{
            return response()->json([
                'success' => false,
                'id' => $id,
                'data' => $data
            ],401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cek_user = auth()->user();

        $data = StokOpname::where('id_stok_opname', $id)->first();
        if($data){
            if($cek_user['id_jabatan'] == '2'){
                $data->update(['status' => 'unapproved']);
                return response()->json([
                    'success' => true
                ],201);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi Pembelian hanya dapat dilakukan Kepala Gudang!',
                ], 409);
            }
        }else{
            return response()->json([
                'success' => false,
                'id' => $id,
                'data' => $data
            ],401);
        }
    }
}
