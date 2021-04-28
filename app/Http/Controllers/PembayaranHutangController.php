<?php

namespace App\Http\Controllers;

use App\Models\Hutang;
use App\Models\Penjualan;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Hutang\PembayaranHutangRequest;

class PembayaranHutangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Hutang::all();
        if($data){
            return response()->json([
                'success' => true,
                'message' => 'Ini Index Data Hutang',
                'data'    => $data
            ], 201);
        }
        return response()->json([
            'success' => false,
            'message' => 'Data Hutang Tidak Ada!',
        ], 404);
    }

    public function indexHutangUser($id)
    {
        if($id){
            $data = Hutang::where('id_user', $id)->get();
            return response()->json([
                'success' => true,
                'message' => 'Data Hutang user', //nama user,
                'data'    => $data
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal Dalam Menampilkan Hutang User',
            ], 409);
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
    public function store(PembayaranHutangRequest $request)
    {
        $data = $request->validated();
        if($data){
            //data tervalidasi
            //get data yg diperlukan
            $data_hutang = Hutang::where('id_hutang', $data['id_hutang'])->first();
            $data_penjualan = Penjualan::where('id_penjualan', $data_hutang['id_penjualan'])->first();

            if($data_hutang['status']!='belum lunas'){
                return response()->json([
                    'success' => false,
                    'message' => 'Hutang Telah Dibayar!',
                ], 409);
            }
            else{
                //data hutang belum dibayar
                $data_hutang = Hutang::where('id_hutang', $data['id_hutang'])->first();
                if($data['jumlah_bayar']!=$data_hutang['besar_hutang']){
                    return response()->json([
                        'success' => false,
                        'message' => 'Jumlah Bayar Tidak Cukup!',
                    ], 409);
                }
                else{
                    //ubah status hutang jadi lunas
                    $update_hutang = $data_hutang->update([
                        'status' => 'lunas'
                    ]);
    
                    //ubah status penjualan, jumlah penjualan
                    $data_penjualan->update([
                        'total_penjualan' => $data['jumlah_bayar'],
                        'status' => 'sudah dibayar'
                    ]);
    
                    $data_user = User::where('id', $data['id_user'])->first();
                    $saldo_hutang_baru = $data_user['saldo_hutang']-$data['jumlah_bayar'];
    
                    $update_saldo_hutang = User::where('id',$data['id_user'])->update([
                        'saldo_hutang' => $saldo_hutang_baru
                    ]);
    
                    if($update_saldo_hutang){
                        return response()->json([
                            'success' => true,
                            'message' => 'Berhasil Melakukan Pembayaran Hutang!',
                            'data'    => $data_hutang
                        ], 200);
                    }
                }
            }             
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Data Tidak Valid!',
            ], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Hutang $hutang)
    {
        if($hutang){
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Hutang',
                'data'    => $hutang
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal dalam menampilkan data Hutang',
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
        //
    }
}
