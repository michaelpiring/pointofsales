<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Penjualan;
use App\Models\Pembelian;
use App\Models\DetailPenjualan;
use App\Models\DetailPembelian;
use Illuminate\Support\Carbon;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weeklyDate =  Carbon::now()->subDays(7);
        $data = [];
        $data['sales'] = Penjualan::whereBetween('tgl_penjualan',[$weeklyDate,Carbon::now()])->count();
        $data['purchase'] = Pembelian::whereBetween('tgl_pembelian',[$weeklyDate,Carbon::now()])->count();
        $data['customer'] = Penjualan::whereBetween('tgl_penjualan',[$weeklyDate,Carbon::now()])->groupBy('id_user')->count();
        $data['gross profit'] = Penjualan::whereBetween('tgl_penjualan',[$weeklyDate,Carbon::now()])->sum('total_penjualan');
        if($data){
            return response()->json([
                'success' => true,
                'data' => $data,
                'date' => $weeklyDate
            ],201);
        }
        else{
            return response()->json([
                'success' => false,
            ],401);
        }
        
        
    }
    public function purchaseChart(Request $request){
        $validate = $request->validate([
            'chart_type' => 'required',
            'id_toko' => 'required'
        ]);
        if($validate){
            if($validate['chart_type'] == 'daily'){
                $data = Pembelian::select('total_pembelian','tgl_pembelian')->where('id_toko',$request->id_toko)->orderBy('tgl_pembelian', 'desc')->get()->groupBy( function($data) {
                    return Carbon::parse($data->tgl_pembelian)->format('Y-m-d');
                    })->map(function ($data){
                        return $data->sum('total_pembelian');
                    })->take(8);
            }elseif($validate['chart_type'] == 'weekly'){
                $data = Penjualan::select('total_pembelian','tgl_pembelian')->where('id_toko',$request->id_toko)->orderBy('tgl_pembelian', 'desc')->get()->groupBy( function($data) {
                    return Carbon::parse($data->tgl_penjualan)->format('W');
                    })->map(function ($data){
                        return $data->sum('total_pembelian');
                    })->take(8);

            }elseif($validate['chart_type'] == 'monthly'){
                $data= Penjualan::select('total_penjualan','tgl_penjualan')->where('id_toko',$request->id_toko)->orderBy('tgl_penjualan', 'desc')->get()->groupBy(function($date) {
                    return Carbon::parse($date->tgl_penjualan)->format('Y-m');
                    })->map(function ($data){
                        return $data->sum('total_penjualan');
                    })->take(8);;
            }
            if($data){  
                $purchase = [];
                $date = [];
                $result = [];
                foreach($data as $key=>$val){
                    $date[] = $key;
                    $sales[] = $val;
                }

                $result['detail'] = $purchase;
                $result['date'] = $date;
                return response()->json([
                    'success' => true,
                    'data' => $result,
                ],201);
            }
        }
        else{
            return response()->json([
                'success' => false,
                ],401);
        }
    }

    public function salesChart(Request $request){
        $validate = $request->validate([
            'chart_type' => 'required',
            'id_toko' => 'required'
        ]);
        if($validate){
            if($validate['chart_type'] == 'daily'){
                $data = Penjualan::select('total_penjualan','tgl_penjualan')->where('id_toko',$request->id_toko)->orderBy('tgl_penjualan', 'desc')->get()->groupBy( function($data) {
                    return Carbon::parse($data->tgl_penjualan)->format('Y-m-d');
                    })->map(function ($data){
                        return $data->sum('total_penjualan');
                    })->take(8);
            }elseif($validate['chart_type'] == 'weekly'){
                $data = Penjualan::select('total_penjualan','tgl_penjualan')->where('id_toko',$request->id_toko)->orderBy('tgl_penjualan', 'desc')->get()->groupBy( function($data) {
                                            return Carbon::parse($data->tgl_penjualan)->format('W');
                                            })->map(function ($data){
                                                return $data->sum('total_penjualan');
                                            })->take(8);
            }elseif($validate['chart_type'] == 'monthly'){
                $data= Penjualan::select('total_penjualan','tgl_penjualan')->where('id_toko',$request->id_toko)->orderBy('tgl_penjualan', 'desc')->get()->groupBy(function($date) {
                                            return Carbon::parse($date->tgl_penjualan)->format('Y-m');
                                            })->map(function ($data){
                                                return $data->sum('total_penjualan');
                                            })->take(8);
            }
            if($data){  
                $sales = [];
                $date = [];
                $result = [];
                foreach($data as $key=>$val){
                    $date[] = $key;
                    $sales[] = $val;
                }

                $result['detail'] = $sales;
                $result['date'] = $date;
                return response()->json([
                    'success' => true,
                    'data' => $result,
                ],201);
            }

        }
        else{
            return response()->json([
                'success' => false,
                ],401);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
