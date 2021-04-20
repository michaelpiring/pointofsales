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
        $weeklyDate =  Carbon::today()->subDays(7);
        $data = [];
        $data['sales_weekly'] = Penjualan::where('tgl_penjualan', '>=', $weeklyDate)->count();
        $data['purchase_weekly'] = Pembelian::where('tgl_pembelian', '>=', $weeklyDate)->count();
        $data['customer_weekly'] = Penjualan::where('tgl_penjualan', '>=', $weeklyDate)->groupBy('id_user')->count();
        $data['gross_profit'] = Penjualan::where('tgl_penjualan', '>=', $weeklyDate)->sum('total_penjualan');
        if($data){
            return response()->json([
                'success' => true,
                'data' => $data
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
            'chart_type' => 'required'
        ]);
        if($validate){
            if($validate['chart_type'] == 'daily'){
                $data = Pembelian::orderBy('tgl_penbelian', 'desc')->take(7)->get();
                return response()->json([
                    'success' => true,
                    'data' => $data
                ],201);
            }elseif($validate['chart_type'] == 'weekly'){
                $data = Pembelian::orderBy(function($date) {
                                            return Carbon::parse($date->tgl_penbelian)->format('W');
                                            })->take(7)->get();
                return response()->json([
                    'success' => true,
                    'data' => $data
                ],201);

            }elseif($validate['chart_type'] == 'monthly'){
                $data = Pembelian::orderBy(function($date) {
                                            return Carbon::parse($date->tgl_penbelian)->format('M');
                                            })->take(7)->get();
                return response()->json([
                'success' => true,
                'data' => $data
                ],201);
            }
        }
        else{
            return response()->json([
                'success' => false,
                ],401);
        }
    }

    public function saleseChart(Request $request){
        $validate = $request->validate([
            'chart_type' => 'required'
        ]);
        if($validate){
            if($validate['chart_type'] == 'daily'){
                $data = Penjualan::orderBy('tgl_penjualan', 'desc')->take(7)->get();
                return response()->json([
                    'success' => true,
                    'data' => $data
                ],201);
            }elseif($validate['chart_type'] == 'weekly'){
                $data = Penjualan::orderBy(function($date) {
                                            return Carbon::parse($date->tgl_penjualan)->format('W');
                                            })->take(7)->get();
                return response()->json([
                    'success' => true,
                    'data' => $data
                ],201);

            }elseif($validate['chart_type'] == 'monthly'){
                $data = Penjualan::orderBy(function($date) {
                                            return Carbon::parse($date->tgl_penjualan)->format('M');
                                            })->take(7)->get();
                return response()->json([
                'success' => true,
                'data' => $data
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
