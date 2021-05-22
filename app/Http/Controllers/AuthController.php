<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\Pegawai\CreatePegawaiRequest;

use Validator;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:user,pegawai', ['except' => ['login', 'registerUser', 'registerPegawai', 'loginPegawai']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){

        if ($token = Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->createNewToken($token);   
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function loginPegawai(Request $request){

        if ($token = Auth::guard('pegawai')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return $this->createNewToken($token);   
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerUser(CreateUserRequest $request) {

        $data = $request->validated();
        if($data){
            $data['password'] = bcrypt($data['password']);
            $data['total_poin_user'] = 0;
            $data['saldo_hutang'] = 0;
            $create_user = User::create($data);
            if($create_user){
                $create_keranjang = Keranjang::create([
                    'id_user' => $create_user['id'],
                    'jumlah_produk' => 0
                ]);
                if($create_keranjang){
                   return response()->json([
                   'success' => true,
                   'message' => 'Berhasil Registrasi user',
                   'data'    => $create_user
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

    public function registerPegawai(CreatePegawaiRequest $request) {

        $data = $request->validated();
        if($data){
            $data['password'] = bcrypt($data['password']);
            $data['status'] = 'aktif';
            $create_pegawai = Pegawai::create($data);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal Dalam Registrasi Pegawai, Data tidak Valid!',
            ], 404);   
        }
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile() {
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 480,
            'user' => auth()->user()
        ]);
    }
}