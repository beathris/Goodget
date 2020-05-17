<?php

namespace App\Http\Controllers;

use App\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function __construct()
    {
    }
    public function viewChartCategory(Request $request){
        $data['session'] = array(
            'id' => $request->session()->get('s_id'),
            'username' => $request->session()->get('s_username'),
            'role' => $request->session()->get('s_role'),
        );
        $data['transaksi']=DB::select("SELECT COUNT(`produk_id`)AS transaksi,SUM(`jumlah`) AS jumlah,SUM(`harga`) AS harga,SUM(`pajak`) AS pajak FROM transaksi");
        $data['query']=DB::select("SELECT * FROM transaksi");
        $data['title'] = "Laporan-Hasil-Perusahaan";
        return view('chart', $data);

    }

    public function calculateReport(Request $request) {
        $data['transaksi']= DB::table('transaksi')
            ->join('nota', 'nota.id', '=', 'transaksi.nota_id')
            ->join('produk', 'produk.id', '=', 'transaksi.produk_id')
            ->join('kategori', 'produk.kategori_id', '=', 'kategori.id')
            ->get();
        $data['chart'] = $data['transaksi']->groupBy('nama_kategori');
//        $data['kategori'] = $data['chart']->each(function ($kategori){
//            $nama = $kategori->jumlah;
//        });

        return $data;

    }

    public function grafik(){
 
        $penjualan = \App\BukuTamu::getGrafik();
        
        return view('chart', compact('penjualan'));
 
 
    }
}
