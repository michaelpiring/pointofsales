<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Pegawai;
use App\Http\Requests\Kategori\CreateKategoriRequest;
use App\Http\Requests\Kategori\UpdateKategoriRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kategori::all();
        return response()->json([
            'success' => true,
            'message' => 'Ini Index Kategori',
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
    public function store(CreateKategoriRequest $request)
    {
        $data = $request->validated();
        if(!$data){
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan Kategori',
            ], 404);
        }
        else{
            $create_kategori = Kategori::create($data);
            if($create_kategori){
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Menambahkan Kategori',
                    'data'    => $create_kategori 
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
    public function show(Kategori $kategori)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Kategori',
            'data'    => $kategori
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
    public function update(UpdateKategoriRequest $request, Kategori $kategori)
    {
        if($kategori){
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
                    $result = $kategori->update([
                        'kategori'  => $data['kategori'],
                    ]);
                    return response()->json([
                        'success'   => true,
                        'message'   => $result,
                    ], 401);
                //     if($result){
                //         return response()->json([
                //             'success'   => true,
                //             'message'   => 'Berhasil meng-update data Kategori',
                //             'data'      => $result
                //         ], 201);
                //     }else{
                //         return response()->json([
                //             'success'   => false,
                //             'message'   => 'gagal Update Kategori',
                //         ], 401);
                //     }
                }else{
                    return response()->json([
                        'success'   => false,
                        'message'   => 'password is not valid',
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
    public function destroy(Kategori $kategori)
    {
        if($kategori){
            $kategori->update([
                'status' => 'nonaktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Menonaktifkan Kategori',
                'data'    => $kategori
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal Menonaktifkan Kategori',
        ], 409);
    }

    public function aktivasiKategori(Kategori $kategori){
        if($kategori['status']!='aktif'){
            $kategori->update([
                'status'=>'aktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengaktifkan Kategori',
                'data'    => $kategori
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal aktivasi Kategori',
        ], 409);
    }
}
