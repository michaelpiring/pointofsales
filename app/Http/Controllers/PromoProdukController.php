<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PromoProduk\CreatePromoProdukRequest;
use App\Models\PromoProduk;
use App\Models\Produk;

class PromoProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = PromoProduk::where('status','aktif')->get();

        foreach ($datas as $data){
            $data_produk = Produk::where('id_produk', $data['id_produk'])->first();

            $data['nama_produk'] = $data_produk['nama_produk'];
        }
        return response()->json([
            'success' => true,
            'message' => 'Ini Index Promo Produk',
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
    public function store(CreatePromoProdukRequest $request)
    {
        $data = $request->validated();
        if(!$data){
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan Promo Produk',
            ], 404);
        }
        else{
            $data['status'] = 'aktif';
            $create_promo = PromoProduk::create($data);
            if($create_promo){
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Menambahkan Promo Produk',
                    'data'    => $create_promo 
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
    public function show($id)
    {
        $promo = PromoProduk::where('id_promo_produk',$id)->first();
        if($promo){
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Promo Produk',
                'data'    => $promo
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal dalam menampilkan data Promo Produk',
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
        $promo = PromoProduk::where('id_promo_produk',$id)->first();
        if($promo['status'] != 'non aktif'){
            $non_aktif = $promo->update([
                'status' => 'non aktif'
            ]);
            if($non_aktif){
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Menonaktifkan Promo Produk',
                    'data'    => $promo
                ], 200);
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal Menonaktifkan Promo Produk',
                    'data' => $promo
                ], 409);
            }
        }
        elseif($promo['status'] != 'aktif'){
            $non_aktif = $promo->update([
                'status' => 'aktif'
            ]);
            if($non_aktif){
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Mengaktifkan Promo Produk',
                    'data'    => $promo
                ], 200);
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal Mengaktifkan Promo Produk',
                    'data' => $promo
                ], 409);
            }
        }
    }
}
