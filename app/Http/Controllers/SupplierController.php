<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Requests\Supplier\CreateSupplierRequest;
use App\Http\Requests\Supplier\UpdateSupplierRequest;
use Illuminate\Support\Facades\Auth; 

use Illuminate\Support\Facades\Hash;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Supplier::all();
        return response()->json([
            'success' => true,
            'message' => 'Ini Index Supplier',
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
    public function store(CreateSupplierRequest $request)
    {
        $data = $request->validated();
        if(!$data){
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan Supplier',
            ], 404);
        }
        else{
            $data['status'] = 'aktif';
            $create_supplier = Supplier::create($data);
            if($create_supplier){
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Buat Supplier',
                    'data'    => $create_supplier 
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
    public function show(Supplier $supplier)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Supplier',
            'data'    => $supplier
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
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        if($supplier){
            $data = $request->validated();
            if(!$data){
                return response()->json([
                    'success'=> false,
                    'message'=> 'Data tidak valid',
                ], 409);
            }
            else{
                $data_pegawai = Pegawai::where('id_pegawai',$data['id_pegawai'])->first();
                if(Hash::check($data['password_pegawai'],$data_pegawai['password'])){
                    $result = $supplier->update([
                        'nama_supplier'             => $data['nama_supplier'],
                        'alamat_supplier'           => $data['alamat_supplier'],
                        'no_telepon_supplier'       => $data['no_telepon_supplier'],
                    ]);
                    if($result){
                        return response()->json([
                            'success'   => true,
                            'message'   => 'Berhasil meng-update data Supplier',
                            'data'      => $result
                        ], 201);
                    }
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
    public function destroy(Supplier $supplier)
    {
        if($supplier['status']!='nonaktif'){
            $supplier->update([
                'status' => 'nonaktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menonaktifkan Supplier',
                'data'      => $supplier
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal menonaktifkan supplier',
        ], 409);
    }

    public function aktivasiSupplier(Supplier $supplier){
        if($supplier['status']!='aktif'){
            $supplier->update([
                'status'=>'aktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengaktifkan Supplier',
                'data'    => $supplier
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal aktivasi Supplier',
        ], 409);
    }
}
