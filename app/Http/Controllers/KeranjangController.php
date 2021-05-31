<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailKeranjang;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Http\Requests\Keranjang\CreateDetailKeranjangRequest;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Keranjang::all();
        if($data){
            return response()->json([
                'success' => true,
                'message' => 'Ini Index Data Keranjang',
                'data'    => $data
            ], 201);
        }
        return response()->json([
            'success' => false,
            'message' => 'Data Keranjang Tidak Ada!',
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
    public function store(CreateDetailKeranjangRequest $request)
    {
        $data = $request->validated();
        if($data){
            $data_produk = Produk::where('id_produk', $data['id_produk'])->first();

            //ambil data keranjang user
            $data_keranjang_user = Keranjang::where('id_user', $data['id_user'])->first();

            //cek stok barang
            if($data['jumlah_produk']>$data_produk['stok']){
                return response()->json([
                    'success' => false,
                    'message' => 'Maaf, Stok Barang Habis!',
                ], 404);   
            }
            else{
                //cek apakah produk udah ada di keranjang ato belum
                $cek_detail_keranjang = DetailKeranjang::where('id_keranjang', $data_keranjang_user['id_keranjang'])
                ->where('id_produk', $data['id_produk'])->first();

                //kalo produk udah ada di keranjang, lakukan update jumlah produk, ga perlu create data detail baru
                if($cek_detail_keranjang){

                    //ASK! ini produk mau ditambah nilainya dengan jumlah produk di request, atau mau diupdate nilainya?
                    //ASK! Pengecekan stok mau dilakukan di penambahan barang keranjang, atau saat checkout?

                    $total_harga = $data_produk['harga_produk']*$data['jumlah_produk'];
                    $data['total_harga'] = $total_harga;
    
                    $update_detail_keranjang1 = DetailKeranjang::where('id_keranjang', $data_keranjang_user['id_keranjang'])
                    ->where('id_produk', $data['id_produk'])->update([
                        'jumlah_produk' => $data['jumlah_produk'],
                        'total_harga' => $total_harga
                    ]);

                    //hitung jumlah produk di detail keranjang
                    $jumlah_produk = DetailKeranjang::where('id_keranjang', $data_keranjang_user['id_keranjang'])
                    ->sum('jumlah_produk');

                    //Update jumlah produk di tb_keranjang
                    $update_keranjang1 = Keranjang::where('id_user', $data['id_user'])->update([
                        'jumlah_produk' => $jumlah_produk
                    ]);
    
                    return response()->json([
                            'success' => true,
                            'message' => 'Berhasil Mengupdate Jumlah Produk di Keranjang',
                            'data'    => $data
                    ], 201);   
                }
                else{
                    //kalo produk belom ada di detail, buat data detail baru
                    $data['id_keranjang'] = $data_keranjang_user['id_keranjang'];

                    //hitung total harga
                    $total_harga = $data_produk['harga_produk']*$data['jumlah_produk'];
                    $data['total_harga'] = $total_harga;
                    $create_detail = DetailKeranjang::create($data);
                    
                    if($create_detail){
    
                        //update jumlah produk dan total harga di keranjang, kayaknya mo dihapus aja sesuai request revisi
                        //$data_keranjang_user['jumlah_produk'] = $data_keranjang_user['jumlah_produk']+$data['jumlah_produk'];
                        //$data_keranjang_user['total_harga'] = $data_keranjang_user['total_harga'] + $data_produk['harga_produk']*$data['jumlah_produk'];
    
                        //$update_keranjang = $data_keranjang_user->update([
                            //'jumlah_produk' => $data_keranjang_user['jumlah_produk'],
                           // 'total_harga'   => $data_keranjang_user['total_harga']
                        //]);

                        //hitung jumlah produk di detail keranjang
                        $jumlah_produk = DetailKeranjang::where('id_keranjang', $data_keranjang_user['id_keranjang'])
                        ->sum('jumlah_produk');

                        //Update jumlah produk di tb_keranjang
                        $update_keranjang = Keranjang::where('id_user', $data['id_user'])->update([
                            'jumlah_produk' => $jumlah_produk
                        ]);
    
                        return response()->json([
                            'success' => true,
                            'message' => 'Berhasil Menambahkan Produk ke Keranjang',
                            'data'    => $data 
                        ], 201);
                    }
                }      
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
        if($id){
            $datas = DetailKeranjang::where('id_keranjang', $id)->get();

            foreach($datas as $data){
                $produk = Produk::where('id_produk',$data['id_produk'])->first();
                $nama_produk = $produk['nama_produk'];
                $data['nama_produk'] = $nama_produk;
                
                $harga_produk = $produk['harga_produk'];
                $data['harga_produk'] = $harga_produk;
                
                $foto_produk = $produk['foto_produk'];
                $data['foto_produk'] = $foto_produk;
            }

            return response()->json([
                'success' => true,
                'message' => 'Detail Data Keranjang',
                'data'    => $datas
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal Dalam Menampilkan Data Detail Keranjang',
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
    public function update(CreateDetailKeranjangRequest $request, $id)
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
