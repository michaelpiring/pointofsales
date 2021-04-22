<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Keranjang;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        if($data){
            return response()->json([
                'success' => true,
                'message' => 'Ini Index User',
                'data'    => $data
            ], 201);
        }
        return response()->json([
            'success' => false,
            'message' => 'Data User Tidak Ditemukan!',
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
    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();
        if($data){
            $data['password'] = bcrypt($data['password']);
            $data['total_poin_user'] = 0;
            $data['saldo_hutang'] = 0;
            $create_nasabah = User::create($data);
            if($create_nasabah){
                $create_keranjang = Keranjang::create([
                    'id_user' => $create_nasabah['id'],
                    'jumlah_produk' => 0
                ]);
                if($create_keranjang){
                   return response()->json([
                   'success' => true,
                   'message' => 'Berhasil Registrasi user',
                   'data'    => $create_nasabah
                ], 201);
                }
            }
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal Dalam Registrasi User, Data tidak Valid!',
            ], 404);   
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if($user){
            return response()->json([
                'success' => true,
                'message' => 'Detail Data User',
                'data'    => $user
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal Dalam Menampilkan Data User',
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
    public function update(UpdateUserRequest $request, User $user)
    {
        if($user){
            $data = $request->validated();
            if($data){
                if(Hash::check($data['password'],$user['password'])){
                    $result = $user->update([
                        'name'            => $data['name'],
                        'alamat_user'         => $data['alamat_user'],
                        'tgl_lahir_user'          => $data['tgl_lahir_user'],
                        'jenis_kelamin_user'        => $data['jenis_kelamin_user']
                    ]);
                    if($result){
                        return response()->json([
                            'success' => true,
                            'message' => 'Berhasil Mengganti Biodata User',
                            'data' => $user
                        ], 201);
                    }
                }
                else{
                    return response()->json([
                        'success' => false,
                        'message' => 'Password salah!',
                    ], 401);
                }
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak valid',
                ], 409);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user['status']!='nonaktif'){
            $user->update([
                'status' => 'nonaktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil menonaktifkan user',
                'data'      => $user
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal menonaktifkan user',
        ], 409);
    }

    public function aktivasiUser(User $user){
        if($user['status']!='aktif'){
            $user->update([
                'status'=>'aktif'
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengaktifkan User',
                'data'    => $user
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Gagal aktivasi User!',
        ], 409);
    }

    public function showUser(Request $request)
    {
        $status = $request->input('status');
        $data_user = User::where('status', $status)->get();
        if($data_user){            
            return response()->json([
                'success' => true,
                'message' => 'Data User',
                'data'    => $data_user
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'User tidak Ditemukan!',
            ], 409);
        }
    }
}
