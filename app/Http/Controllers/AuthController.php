<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Hash;

use Validator;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['loginUser', 'registerUser', 'loginPegawai', 'registerPegawai']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginUser(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('email', $request->email)->first();
        if (!Hash::check($request->password, $user->password, [])){
            throw new \Exception('Data login salah!');
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
                    $validator->validated(),
                    ['password' => bcrypt($request->password)]
                ));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logoutUser() {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshUser() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profileUser() {
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
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

    /**
     * Login Pegawai
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginPegawai(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pegawai = Pegawai::where('email_pegawai', $request->email)->first();
        if (!Hash::check($request->password, $pegawai->password_pegawai, [])){
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    /**
     * Register Pegawai.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerPegawai(Request $request) {
        $validator = Validator::make($request->all(), [
            'nama_pegawai' => 'required|string|between:2,100',
            'email_pegawai' => 'required|string|email|max:100|unique:tb_pegawai',
            'password_pegawai' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $pegawai = Pegawai::create(array_merge(
                    $validator->validated(),
                    ['password_pegawai' => bcrypt($request->password)]
                ));

        return response()->json([
            'message' => 'Pegawai successfully registered',
            'pegawai' => $pegawai
        ], 201);
    }

    /**
     * Log out Pegawai (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logoutPegawai() {
        auth()->logout();

        return response()->json(['message' => 'Pegawai successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshPegawai() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated Pegawai.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profilePegawai() {
        return response()->json(auth()->user());
    }

    

}