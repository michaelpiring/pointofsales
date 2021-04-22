<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Requests\Toko\CreateTokoRequest;
use App\Http\Requests\Toko\UpdateTokoRequest;
use Illuminate\Support\Facades\Auth; 

use Illuminate\Support\Facades\Hash;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Toko::all();
        return response()->json([
            'success' => true,
            'message' => 'Ini Index Toko',
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
    public function store(CreateTokoRequest $request)
    {
        $data = $request->validated();
        if(!$data){
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan Toko',
            ], 404);
        }
        else{
            $data['status'] = 'aktif';
            $create_toko = Toko::create($data);
            if($create_toko){
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Buat Toko',
                    'data'    => $create_toko 
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
    public function show(Toko $Toko)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Toko',
            'data'    => $Toko
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
    public function update(UpdateTokoRequest $request, Toko $Toko)
    {
        if($Toko){
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
                    $result = $Toko->update([
                        'nama_toko'             => $data['nama_toko'],
                        'alamat_toko'           => $data['alamat_toko'],
                        'no_telepon_toko'       => $data['no_telepon_toko'],
                    ]);
                    if($result){
                        return response()->json([
                            'success'   => true,
                            'message'   => 'Berhasil meng-update data Toko',
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
    public function destroy(Toko $Toko)
    {
        if($Toko){
            $Toko->update([
                'status' => 'non aktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Mengganti status Toko Menjadi Non Aktif',
                'data'    => $Toko
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal Non aktifkan Toko',
        ], 409);
    }

    public function aktivasiToko(Toko $toko){
        if($toko['status']!='aktif'){
            $toko->update([
                'status'=>'aktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengaktifkan Toko',
                'data'    => $toko
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal aktivasi Toko',
        ], 409);
    }
}
