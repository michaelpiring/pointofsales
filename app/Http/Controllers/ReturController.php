<?php

namespace App\Http\Controllers;

use App\Models\Retur;
use App\Models\Produk;
use App\Models\Pegawai;
use App\Http\Requests\Retur\CreateReturRequest;
use App\Http\Requests\Retur\UpdateReturRequest;
use App\Http\Requests\Retur\ValidasiReturRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use Carbon\Carbon;

class ReturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Retur::all();
        return response()->json([
            'success' => true,
            'message' => 'Ini Index Retur',
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
    public function store(CreateReturRequest $request)
    {
        $data = $request->validated();

        if(!$data){
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan data Retur! Data Tidak Valid',
            ], 404);
        }
        else{
            $data['tgl_retur'] = now();
            $create_retur = Retur::create($data);

            $data_produk = Produk::where('id_produk',$data['id_produk'])->first();
            //pengecekan status retur
            if($data['status']='tidak_valid'){
                //retur tidak valid
                //barang stay di toko
                $stok = $data_produk['stok'];                
            }
            if($data['status']!='tidak_valid'){                
                //update stok produk
                $stok = $data_produk['stok']-$data['jumlah_barang'];
                
            }

            $update_stok = $data_produk->update([
                'stok' => $stok
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Berhasil Menambahkan Data Retur',
                'data'    => $create_retur 
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Retur $retur)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Retur',
            'data'    => $retur
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
    public function update(UpdateReturRequest $request, Retur $retur)
    {
        $data = $request->validated();

        if(!$data){
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak Valid',
            ], 404);
        }
        else{
            $data_pegawai = Pegawai::where('id_pegawai',$data['id_pegawai'])->first();
            if(Hash::check($data['password_pegawai'],$data_pegawai['password_pegawai'])){
                $result = $retur->update([
                    'id_toko'             => $data['id_toko'],
                    'id_produk'           => $data['id_produk'],
                    'id_pegawai'          => $data['id_pegawai'],
                    'id_supplier'         => $data['id_supplier'],
                    'jumlah_barang'       => $data['jumlah_barang'],
                    'keterangan'          => $data['keterangan']
                ]);
            }

            //pengecekan status retur
            $data_produk = Produk::where('id_produk',$data['id_produk'])->first();
            
            if($data['status']='tidak_valid'){
                //retur tidak valid
                //barang stay di toko
                $stok = $data_produk['stok'];                
            }
            if($data['status']!='tidak_valid'){                
                //update stok produk
                $stok = $data_produk['stok']-$data['jumlah_barang'];
                
            }

            $update_stok = $data_produk->update([
                'stok' => $stok
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Berhasil Update Data Retur',
                'data'    => $retur 
            ], 201);
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
        //
    }

    public function validasiRetur(ValidasiReturRequest $request, Retur $retur)
    {
        $data = $request->validated();

        if(!$data){
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak Valid',
            ], 404);
        }
        else{
            $data_retur = Retur::where('id_retur',$data['id_retur'])->first();
            if($data_retur['status']!='tidak_valid'){
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal Validasi Data Retur, Data Sudah Valid!',
                ], 404);
            }
            else{
                $data_pegawai = Pegawai::where('id_pegawai',$data['id_pegawai'])->first();
                if(Hash::check($data['password_pegawai'],$data_pegawai['password_pegawai'])){
                    $result = $retur->update([
                        'status'             => 'valid'
                    ]);
                }

                //update stok produk
                $data_produk = Produk::where('id_produk',$data_retur['id_produk'])->first();
                $stok = $data_produk['stok']-$data_retur['jumlah_barang'];

                $update_stok = $data_produk->update([
                    'stok' => $stok
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Validasi Data Retur',
                    'data'    => $retur 
                ], 201);
            }
        }
    }
}
