<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailKeranjang;
use App\Models\Keranjang;
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
        $data = DetailKeranjang::all();
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
            $data_keranjang_user = Keranjang::where('id_user', $data['id_user'])->first();
            $data['id_keranjang'] = $data_keranjang_user['id_keranjang'];
            $create_detail = DetailKeranjang::create($data);
                if($create_detail){
                    
                   return response()->json([
                   'success' => true,
                   'message' => 'Berhasil Menambahkan Produk ke Keranjang',
                   'data'    => $data 
                ], 201);
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
    public function show(DetailKeranjang $detailkeranjang)
    {
        if($detailkeranjang){
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Keranjang',
                'data'    => $detailkeranjang
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
