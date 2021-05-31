<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PromoSupplier\CreatePromoSupplierRequest;
use App\Models\PromoSupplier;
use App\Models\Supplier;

class PromoSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = PromoSupplier::where('status','aktif')->get();

        foreach ($datas as $data){
            $data_supplier = Supplier::where('id_supplier', $data['id_supplier'])->first();

            $data['nama_supplier'] = $data_supplier['nama_supplier'];
        }
        return response()->json([
            'success' => true,
            'message' => 'Ini Index Promo Supplier',
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
    public function store(CreatePromoSupplierRequest $request)
    {
        $data = $request->validated();
        if(!$data){
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan Promo Supplier',
            ], 404);
        }
        else{
            $data['status'] = 'aktif';
            $create_promo = PromoSupplier::create($data);
            if($create_promo){
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Menambahkan Promo Supplier',
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
        $promo = PromoSupplier::where('id_promo_supplier',$id)->first();
        if($promo){
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Promo Supplier',
                'data'    => $promo
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal dalam menampilkan data Promo Supplier',
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
        $promo = PromoSupplier::where('id_promo_supplier',$id)->first();
        if($promo['status'] != 'non aktif'){
            $non_aktif = $promo->update([
                'status' => 'non aktif'
            ]);
            if($non_aktif){
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Menonaktifkan Promo Supplier',
                    'data'    => $promo
                ], 200);
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal Menonaktifkan Promo Supplier',
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
                    'message' => 'Berhasil Mengaktifkan Promo Supplier',
                    'data'    => $promo
                ], 200);
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal Mengaktifkan Promo Supplier',
                    'data' => $promo
                ], 409);
            }
        }
    }
}
