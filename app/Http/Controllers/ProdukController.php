<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Supplier;
use App\Models\Kategori;
use App\Models\Pegawai;

use Illuminate\Http\Request;
use App\Http\Requests\Produk\CreateProdukRequest;
use App\Http\Requests\Produk\UpdateProdukRequest;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Hash;

use Faker\Factory as Faker;
use Faker\Provider\Barcode;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Produk::where('status_produk','1')->get();

        foreach($datas as $data){
            $supplier = Supplier::where('id_supplier',$data['id_supplier'])->first();
            $nama_supplier = $supplier['nama_supplier'];
            $data['supplier'] = $nama_supplier;

            $kategori = Kategori::where('id_kategori',$data['id_kategori'])->first();
            $nama_kategori = $kategori['kategori'];
            $data['kategori'] = $nama_kategori;
        }
        return response()->json([
            'success' => true,
            'message' => 'Ini Index Produk',
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
    public function store(CreateProdukRequest $request)
    {
        $faker = Faker::create();
        $data = $request->validated();
        if(!$data){
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan Produk'
            ], 404);
        }
        else{
            $supplier = Supplier::where('id_supplier', $data['id_supplier'])->first();

            $lokasi_gambar = 'public/'.'Supplier'.$data['id_supplier'];

            $foto_produk = $request->file('foto_produk');

            $simpan_gambar = Storage::put($lokasi_gambar, $foto_produk);

            $nama_gambar = Storage::url('Supplier'.$data['id_supplier']."/".basename($simpan_gambar));
            $data['foto_produk'] = $nama_gambar;

            $data['status_produk'] = '1';
            $data['kode_barcode'] = $faker->ean13;
            $create_produk = Produk::create($data);
            if($create_produk){
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil menambahkan Produk',
                    'data'    => $request,
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
            $supplier = Supplier::where('id_supplier',$produk['id_supplier'])->first();
            $kategori = Kategori::where('id_kategori',$produk['id_kategori'])->first();
            $nama_supplier = $supplier['nama_supplier'];
            $nama_kategori = $kategori['kategori'];

            $produk['supplier'] = $nama_supplier;
            $produk['kategori'] = $nama_kategori;
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

    public function showByBarcode(Request $request)
    {
        $kode_barcode = $request->input('kode_barcode');
        $data_produk = Produk::where('kode_barcode', $kode_barcode)->first();
        if($data_produk){            
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Produk',
                'data'    => $data_produk
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak Ditemukan!',
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
                $lokasi_gambar = 'public/'.'Supplier'.$data['id_supplier'];

                $foto_produk = $request->file('foto_produk');
                if($foto_produk){  
                    $simpan_gambar = Storage::put($lokasi_gambar, $foto_produk);

                    $nama_gambar = Storage::url('Supplier'.$data['id_supplier']."/".basename($simpan_gambar));
                    $data['foto_produk'] = $nama_gambar;
                }else{
                    $data['foto_produk'] = $produk->foto_produk;
                }

                $data_pegawai = Pegawai::where('id_pegawai',$data['id_pegawai'])->first();
                if(Hash::check($data['password'],$data_pegawai['password'])){
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
                        'foto_produk'        => $data['foto_produk']
                    
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
        if($produk['status_produk']!='0'){
            $produk->update([
                'status_produk' => '0'
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
        if($produk['status_produk']!='1'){
            $produk->update([
                'status_produk'=>'1'
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
