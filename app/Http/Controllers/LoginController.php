<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Hash;


class LoginController extends Controller
{
    public function store (Request $request){
       
        $pegawai=Pegawai::where('email',$request->email)->first();
        if(Hash::check($request->password_pegawai,$pegawai->password_pegawai)){
            // $token = $user->createToken('nApp')->accessToken;
            return response()->json(['success' => '1','id' => $pegawai->id,'nama_pegawai' => $pegawai->nama_pegawai,'email' => $pegawai->email]);
        }
        // dd($user);
        
        return response()->json(['success' => '2']);
        
    }
}
