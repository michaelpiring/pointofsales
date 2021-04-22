<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Pegawai\CreatePegawaiRequest;
use App\Http\Requests\Pegawai\UpdatePegawaiRequest;
use App\Http\Requests\Pegawai\UpdatePasswordPegawaiRequest;
use App\Models\Pegawai;

use Hash;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pegawai::all();
        if($data){
            return response()->json([
                'success' => true,
                'message' => 'Ini Index Pegawai',
                'data'    => $data
            ], 201);
            return response()->json([
                'success' => false,
                'message' => 'Tidak ditemukan data Pegawai',
            ], 404);
        }
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
    public function store(CreatePegawaiRequest $request)
    {
        $data = $request->validated();
        if($data){
            $data['password_pegawai'] = bcrypt($data['password_pegawai']);
            $data['status'] = 'aktif';
            $create_pegawai = Pegawai::create($data);
            if($create_pegawai){
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil Registrasi Pegawai',
                    'data'    => $create_pegawai 
                ], 201);
            }
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal Dalam Registrasi Pegawai',
            ], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        if($pegawai){
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Pegawai',
                'data'    => $pegawai
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal Dalam Menampilkan Data Pegawai',
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
    public function update(UpdatePegawaiRequest $request, Pegawai $pegawai)
    {
        if($pegawai){
            $data = $request->validated();
            if($data){
                if(Hash::check($data['password_pegawai'],$pegawai['password_pegawai'])){
                    $result = $pegawai->update([
                        'id_toko' => $data['id_toko'],
                        'id_jabatan' => $data['id_jabatan'],
                        'id_divisi' => $data['id_divisi'],
                        'nama_pegawai' => $data['nama_pegawai'],
                        'nik_pegawai' => $data['nik_pegawai'],
                        'alamat_pegawai' => $data['alamat_pegawai'],
                        'tgl_lahir_pegawai' => $data['tgl_lahir_pegawai']
                    ]);
                    return response()->json([
                        'success' => true,
                        'message' => 'Berhasil Mengubah Data Pegawai',
                        'data' => $pegawai
                    ],201);
                }
                else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Password Salah!'
                    ],403);
                }
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal Update Data Pegawai, Data tidak valid!', 
                ],409);
        }
        return response()->json([
            'success' => false,
            'message' => 'Data Pegawai tidak ditemukan!'
        ],404);
        }
    }

    public function changePassword(UpdatePasswordPegawaiRequest $request, Pegawai $pegawai){
        if($pegawai){
            $data = $request->validated();
            if($data){
                if(Hash::check($data['password_lama'],$pegawai['password_pegawai'])){
                    $new_password = bcrypt($data['password_baru']);
                    $pegawai->update([
                        'password_pegawai' => $new_password
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Berhasil Mengubah Password Pegawai'
                    ],201);
                }
                else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Password Salah!'
                    ],403);
                }
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak valid!', 
                ],409);
            }
        }
        return response()->json([
            'success' => false,
            'message' => 'Data Pegawai tidak ditemukan!'
        ],404);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        if($pegawai['status']!='nonaktif'){
            $pegawai->update([
                'status' => 'nonaktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menonaktifkan Pegawai',
                'data'      => $pegawai
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal menonaktifkan Pegawai',
        ], 409);
    }

    public function aktivasiPegawai(Pegawai $pegawai){
        if($pegawai['status']!='aktif'){
            $pegawai->update([
                'status'=>'aktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengaktifkan Pegawai',
                'data'    => $pegawai
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal aktivasi Pegawai!',
        ], 409);
    }
}
