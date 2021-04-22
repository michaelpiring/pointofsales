<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Supplier;
use App\Models\Pegawai;

use Illuminate\Http\Request;
use App\Http\Requests\Produk\CreateProdukRequest;
use App\Http\Requests\Produk\UpdateProdukRequest;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Hash;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Produk::all();
        return response()->json([
            'success' => true,
            'message' => 'Ini Index Produk',
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
    public function store(CreateProdukRequest $request)
    {
        $data = $request->validated();
        if(!$data){
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan Produk'
            ], 404);
        }
        else{
            $supplier = Supplier::where('id_supplier', $data['id_supplier'])->first();

            $lokasi_gambar = 'Supplier'.$data['id_supplier'];

            $foto_produk = $request->file('foto_produk');

            $simpan_gambar = Storage::put($lokasi_gambar, $foto_produk);

            $nama_gambar = basename($simpan_gambar);
            $data['foto_produk'] = $nama_gambar;

            $data['status_produk'] = 'aktif';
            $create_produk = Produk::create($data);
            if($create_produk){
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil menambahkan Produk',
                    'data'    => $create_produk,
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
    public function show(Produk $produk)
    {
        if($produk){
            $lokasi_gambar = 'Supplier'.$produk['id_supplier'].'/'.$produk['foto_produk'];
            $produk['gambar_produk'] = $lokasi_gambar;
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Produk',
                'data'    => $produk
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal dalam menampilkan data produk',
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
    public function update(UpdateProdukRequest $request, Produk $produk)
    {
        if($produk){
            $data = $request->validated();
            if(!$data){
                return response()->json([
                    'success'=> false,
                    'message'=> 'Data tidak valid',
                ], 409);
            }
            else{
                $data_pegawai = Pegawai::where('id_pegawai',$data['id_pegawai'])->first();
                if(Hash::check($data['password_pegawai'],$data_pegawai['password_pegawai'])){
                    $result = $produk->update([
                        'id_supplier'        => $data['id_supplier'],
                        'id_kategori'        => $data['id_kategori'],
                        'id_toko'            => $data['id_toko'],
                        'nama_produk'        => $data['nama_produk'],
                        'stok'               => $data['stok'],
                        'harga_produk'       => $data['harga_produk'],
                        'harga_beli'         => $data['harga_beli'],
                        'berat_produk'       => $data['berat_produk'],
                        'deskripsi_produk'   => $data['deskripsi_produk'],
                        'kode_barcode'       => $data['kode_barcode'],
                    ]);
                    if($result){
                        return response()->json([
                            'success'   => true,
                            'message'   => 'Berhasil meng-update Produk',
                            'data'      => $result
                        ], 201);
                    }
                    else{
                        return response()->json([
                            'success'   => false,
                            'message'   => 'Gagal meng-update Produk',
                        ], 401);
                    }
                }
                else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Password salah',
                    ], 401);
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        if($produk['status_produk']!='non aktif'){
            $produk->update([
                'status_produk' => 'non aktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menonaktifkan produk',
                'data'      => $produk
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal menonaktifkan produk',
        ], 409);
    }

    public function aktivasiProduk(Produk $produk){
        if($produk['status_produk']!='aktif'){
            $produk->update([
                'status_produk'=>'aktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengaktifkan produk',
                'data'    => $produk
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal aktivasi produk',
        ], 409);
    }
    
}
