<?php

namespace App\Http\Controllers;

use App\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $data['title'] = "Laporan-Hasil-Perusahaan";
        return view('chart', $data);

    }

    public function calculateReport(Request $request)
    {
        $transaksi = Transaksi::join('nota', 'nota.id', '=', 'transaksi.nota_id')
            ->join('produk', 'produk.id', '=', 'transaksi.produk_id')
            ->join('kategori', 'produk.kategori_id', '=', 'kategori.id')
            ->select('transaksi.jumlah', 'nota.tgl_transaksi', 'kategori.nama_kategori')
            ->get();

        $transaksi->each(function ($data) {
            $data->tgl_transaksi = Carbon::parse($data->tgl_transaksi)->format('d-m-Y');
        });

        $categories = $transaksi->groupBy('nama_kategori')->map(function ($data) {
            return collect($data)->groupBy('tgl_transaksi');
        });

        return $categories->map(function ($category) {
            return $category->map(function ($tgl_transaksi) {
                return $tgl_transaksi->map(function ($data) {
                    return $data->jumlah;
                })->sum();
            });
        });
    }
}
