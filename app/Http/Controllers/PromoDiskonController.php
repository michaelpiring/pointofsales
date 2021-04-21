<?php

namespace App\Http\Controllers;

use App\Models\PromoDiskon;
use Illuminate\Http\Request;
use App\Http\Requests\PromoDiskon\CreatePromoDiskonRequest;

class PromoDiskonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PromoDiskon::all();
        return response()->json([
            'success' => true,
            'message' => 'Ini Index Promo Diskon',
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
    public function store(CreatePromoDiskonRequest $request)
    {
        $data = $request->validated();
        if(!$data){
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan Promo Diskon',
            ], 404);
        }
        else{
            $data['status'] = 'aktif';
            $create_promo = PromoDiskon::create($data);
            if($create_promo){
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Menambahkan Promo',
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
        $promo = PromoDiskon::where('id_promo_diskon',$id)->first();
        if($promo){
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Promo',
                'data'    => $promo
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal dalam menampilkan data Promo',
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
        $promo = PromoDiskon::where('id_promo_diskon',$id)->first();
        if($promo['status'] != 'non aktif'){
            $non_aktif = $promo->update([
                'status' => 'non aktif'
            ]);
            if($non_aktif){
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Menonaktifkan Promo',
                    'data'    => $promo
                ], 200);
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal Menonaktifkan Promo',
                    'data' => $promo
                ], 409);
            }
        }  
    }
}
