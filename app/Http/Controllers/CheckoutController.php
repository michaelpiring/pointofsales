<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Keranjang;
use App\Models\DetailKeranjang;
use App\Models\PromoDiskon;
use App\Models\PromoProduk;
use App\Http\Requests\Checkout\CreateCheckoutRequest;
use Illuminate\Http\Request;

use Carbon\Carbon;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Checkout::all();
        return response()->json([
            'success' => true,
            'message' => 'Ini Index Checkout',
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
    public function store(CreateCheckoutRequest $request)
    {
        $data = $request->validated();
        if($data){

            //get data-data yg diperlukan (keranjang)
            $data_keranjang_user = Keranjang::where('id_user', $data['id_user'])->first();

            //cek apakah checkout udah ada ato belum (pesanan udah ada ato belom), udah dibayar ato belum
            $cek_checkout = Checkout::where('id_keranjang', $data_keranjang_user['id_keranjang'])
            ->where(['status' => 'belum dibayar'])
            ->first();

            if($cek_checkout){
                return response()->json([
                    'success' => false,
                    'message' => 'Checkout telah Dilakukan! Segera lakukan Pembayaran',
                ], 404); 
            }
            else{
                //checkout belum dilakukan, buat data checkout.

                //get semua detail keranjang, sum total harga barang
                $total_harga = DetailKeranjang::where('id_keranjang', $data_keranjang_user['id_keranjang'])
                ->sum('total_harga');

                //get all data in promo
                //$data_promo = PromoDiskon::all();

                //cek masukin promo ato nggak
                //disini user tidak masukin kode promo, kirim request '-' dari app
                if($data['kode_promo']=="-"){
                    //hitung total harga tanpa kode promo

                    $jumlah_harga = $total_harga;
                    $pajak = $jumlah_harga*0.05;

                    $jumlah_bayar = $jumlah_harga+$pajak;

                    //create data checkout
                    $data['id_keranjang'] = $data_keranjang_user['id_keranjang'];
                    $data['tgl_checkout'] = now();
                    $data['total_harga'] = $jumlah_harga;
                    $data['pajak'] = $pajak;
                    $data['total_checkout'] = $jumlah_bayar;
                    $data['status'] = 'belum dibayar';

                    $create_checkout = Checkout::create($data);
                    //buat cek kode promo, kalo data promo ada, kurangi total checkout dgn promo

                    return response()->json([
                        'success' => true,
                        'promo' => false,
                        'message' => 'Berhasil buat Pesanan!',
                        'data'    => $create_checkout
                    ], 200);

                }
                else{
                    //user masukin kode promo, validasi kode promo.

                    //cek promo ada ato nggak
                    $cek_promo = PromoDiskon::where('kode_promo', $data['kode_promo'])->first();
                    $cek_promo_produk = PromoProduk::where('kode_promo', $data['kode_promo'])->first();
                    $cek_promo_supplier = PromoSupplier::where('kode_promo', $data['kode_promo'])->first();

                    //masukin kode promo, kode promonya benar
                    if($cek_promo){
                        $jumlah_harga = $total_harga-$cek_promo['besar_promo_diskon'];

                        $pajak = $jumlah_harga*0.05;

                        $jumlah_bayar = $jumlah_harga+$pajak;

                        //create data checkout
                        $data['id_keranjang'] = $data_keranjang_user['id_keranjang'];
                        $data['tgl_checkout'] = now();
                        $data['total_harga'] = $total_harga;
                        $data['pajak'] = $pajak;
                        $data['total_checkout'] = $jumlah_bayar;
                        $data['status'] = 'belum dibayar';

                        $create_checkout = Checkout::create($data);

                        $create_checkout['besar_diskon'] = $cek_promo['besar_promo_diskon'];
                        //buat cek kode promo, kalo data promo ada, kurangi total checkout dgn promo

                        return response()->json([
                            'success' => true,
                            'promo' => true,
                            'message' => 'Berhasil buat Pesanan!',
                            'data'    => $create_checkout
                        ], 200);
                    }
                    elseif($cek_promo_produk){

                        //jumlah produk yg kena promo produk
                        $produk_kena_diskon = DetailKeranjang::where('id_keranjang', $data_keranjang_user['id_keranjang'])
                            ->where('id_produk',$cek_promo_produk['id_produk'])->first();

                        //hitung jumlah promo
                        $besar_promo_produk = $cek_promo_produk['besar_promo_diskon']*$produk_kena_diskon['jumlah_produk'];

                        $jumlah_harga = $total_harga-$besar_promo_produk;

                        $pajak = $jumlah_harga*0.05;

                        $jumlah_bayar = $jumlah_harga+$pajak;

                        //create data checkout
                        $data['id_keranjang'] = $data_keranjang_user['id_keranjang'];
                        $data['tgl_checkout'] = now();
                        $data['total_harga'] = $total_harga;
                        $data['pajak'] = $pajak;
                        $data['total_checkout'] = $jumlah_bayar;
                        $data['status'] = 'belum dibayar';

                        $create_checkout = Checkout::create($data);

                        $create_checkout['besar_diskon'] = $besar_promo_produk;
                        //buat cek kode promo, kalo data promo ada, kurangi total checkout dgn promo

                        return response()->json([
                            'success' => true,
                            'promo' => true,
                            'message' => 'Berhasil buat Pesanan!',
                            'data'    => $create_checkout
                        ], 200);
                    }
                    elseif($cek_promo_supplier){

                        //jumlah produk yg kena promo produk
                        $produk_kena_diskon = DetailKeranjang::where('id_keranjang', $data_keranjang_user['id_keranjang'])
                            ->where('id_produk',$cek_promo_produk['id_produk'])->first();

                        //hitung jumlah promo
                        $besar_promo_produk = $cek_promo_produk['besar_promo_diskon']*$produk_kena_diskon['jumlah_produk'];

                        $jumlah_harga = $total_harga-$besar_promo_produk;

                        $pajak = $jumlah_harga*0.05;

                        $jumlah_bayar = $jumlah_harga+$pajak;

                        //create data checkout
                        $data['id_keranjang'] = $data_keranjang_user['id_keranjang'];
                        $data['tgl_checkout'] = now();
                        $data['total_harga'] = $total_harga;
                        $data['pajak'] = $pajak;
                        $data['total_checkout'] = $jumlah_bayar;
                        $data['status'] = 'belum dibayar';

                        $create_checkout = Checkout::create($data);

                        $create_checkout['besar_diskon'] = $besar_promo_produk;
                        //buat cek kode promo, kalo data promo ada, kurangi total checkout dgn promo

                        return response()->json([
                            'success' => true,
                            'promo' => true,
                            'message' => 'Berhasil buat Pesanan!',
                            'data'    => $create_checkout
                        ], 200);
                    }
                    else{
                        //masukin kode promo, kode promo nya salah
                        return response()->json([
                            'success' => false,
                            'message' => 'Kode Promo tidak Valid!',
                        ], 404);
                    }
                }             
            }
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Data tidak Valid!',
            ], 404);  
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Checkout $checkout)
    {
        if($checkout){
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Checkout',
                'data'    => $checkout
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal dalam menampilkan Data Checkout',
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
