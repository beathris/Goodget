<?php

namespace App\Http\Controllers;

use App\Keranjang;
use App\Nota;
use App\Produk;
use App\Transaksi;
use App\User;
use MongoDB\Driver\Session;
use PDF;
use URL;
use Carbon\Carbon;
use FontLib\TrueType\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Mockery\Matcher\Not;
use mysql_xdevapi\Exception;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Console\Input\Input as i;
use Throwable;

class ProdukController extends Controller
{
    public function _construct()
    {
    }

    public function index(Request $request)
    {
        if($request->session()->get('s_status') == "active"){
            $data['session'] = array(
                'id' => $request->session()->get('s_id'),
                'username' => $request->session()->get('s_username'),
                'role' => $request->session()->get('s_role'),
            );
        $produk = Produk::all();
        return view('produk_index', ['produk' => $produk]);
        }else {
            return redirect('/login');
        }

    }

    public function barangKeranjang($id, Request $request)
    {
        $user_id = $request->session()->get('s_id');
        $produk = DB::selectOne("SELECT * FROM produk WHERE id=?", [$id]);
        $data['keranjang'] = DB::table('keranjang')
            ->select('produk.nama_barang', 'produk.harga_jual', 'keranjang.subtotal',
                'keranjang.jumlah', 'keranjang.produk_id', 'keranjang.user_id')
            ->join('produk', 'keranjang.produk_id', '=', 'produk.id')
            ->where('produk_id', $id)
            ->get();

        $total_jumlah = collect($data['keranjang'])->sum('jumlah') + 1;
        $harga_jual = collect($produk)->get('harga_jual');
        $subtotal = $harga_jual * $total_jumlah;
        $subtotal1 = $harga_jual * $total_jumlah;
        $isNotExist = is_null(collect($data['keranjang'])->first(function ($value) use ($id) {
            return $value->produk_id == $id;
        }));

        if ($isNotExist) {
            DB::table('keranjang')->insert([
                'subtotal' => $subtotal,
                'jumlah' => $total_jumlah,
                'produk_id' => $id,
                'user_id' => $user_id
            ]);
        } else {
            DB::table('keranjang')
                ->where('produk_id', $id)
                ->update([
                    'jumlah' => $total_jumlah,
                    'subtotal' => $subtotal1
                ]);
        }
        return redirect('/produk');
    }

    public function dataKeranjang()
    {
        $data['keranjang'] = \App\Keranjang::all();

        return view('keranjang', $data);
    }

    public function keranjang()
    {
        $data['keranjang'] = DB::table('keranjang')
            ->select('produk.nama_barang', 'produk.harga_jual', 'produk.foto', 'keranjang.subtotal',
                'keranjang.jumlah', 'keranjang.produk_id', 'keranjang.user_id')
            ->join('produk', 'keranjang.produk_id', '=', 'produk.id')
            ->get();
        return view('keranjang', $data);
    }

    public function checkOut(Request $request)
    {

        if ($request->method() == "POST") {
            $collection = Produk::all();
            $response = [];
            $response["error"] = array();
            $total = 0;
            $product_id = [];
            $qty_by_product_id = [];
            $user_id = 0;
            foreach ($request->items["items"] as $item) {
                array_push($product_id, $item["product_id"]);
                $total += $item["qty"] * $item["price"];
                $qty_by_product_id[$item["product_id"]] = $item["qty"];
                $user_id = $item["user_id"];
            }

            $products = $collection->whereIn('id', $product_id)
                ->each(function ($product) use ($response, $qty_by_product_id) {
                    if ($product->stok < $qty_by_product_id[$product->id]) {
                        $response["error"][$product->id] = "Stok untuk " . $product->nama_barang . " tidak mencukupi";
                    } else {
                        $product->stok -= $qty_by_product_id[$product->id];
                    }
                });

            if ($response["error"] != null) return $response;

            $transactions = collect($request->items["items"])->map(function ($item) {
                $transaksi = new Transaksi();
                $transaksi->harga = $item["price"];
                $transaksi->pajak = 0.1 * $item["price"] * $item["qty"];
                $transaksi->jumlah = $item["qty"];
                $transaksi->produk_id = $item["product_id"];
                $transaksi->nama_barang = $item["name"];
                return $transaksi;
            });

            $nota = new Nota();
            $nota->tgl_transaksi = Carbon::now();
            $nota->total_belanja = $total;
            $nota->status = "Sudah Dibayar";
            $nota->user_id = $user_id;
            $response["nota"] = $nota;
            $response["success"] = $nota->save();
            $nota->transaksi()->saveMany($transactions);
            Keranjang::where('user_id', $user_id)->delete();
            $products->each(function ($product) {
                $product->save();
            });
            $response["redirect"] = action('ProdukController@nota', ['id' => $nota["id"]]);
            return $response;
        }
    }

    public function nota(Request $request)
    {
        $user_id = $request->session()->get('s_id');
        $id = $request->query('id');
        $data['user']= User::all();
        $data['transaksi'] = DB::table('transaksi')
            ->select('nota.total_belanja', 'nota.tgl_transaksi', 'user.username', 'transaksi.jumlah',
                'transaksi.nama_barang', 'transaksi.harga', 'transaksi.pajak')
            ->join('nota', 'nota.id', '=', 'transaksi.nota_id')
            ->join('user', 'nota.user_id', '=', 'user.id')
            ->where('nota_id', '=', $id)
            ->get();
        $response = [];
        $trasactions = collect($data['transaksi'])->map(function ($trasaction) use ($id) {
            $tr["jumlah"] = $trasaction->jumlah;
            $tr["harga"] = $trasaction->harga;
            $tr["nama_barang"] = $trasaction->nama_barang;
            $tr["subtotal"] = $trasaction->jumlah * $trasaction->harga;
            return $tr;
        })->all();

        $response["transaksi"] = $trasactions;
        $response["username"]= collect(User::where('id',$user_id)->get())->first()->username;
        $response["id"] = $id;
        $response["pajak"] = collect($data['transaksi'])->sum("pajak");
        $response["total_belanja"] = collect($data['transaksi'])->get(0)->total_belanja;
        $response["total_bayar"] = $response["pajak"] + $response["total_belanja"];
        $response["tgl_transaksi"] = $data['transaksi']->get(0)->tgl_transaksi;
        return view('nota', $response);

    }

    public function downloadNota(Request $request, $id)
    {
        $user_id = $request->session()->get('s_id');
        $data['title'] = "Reporting - laracms";
        $data['transaksi'] = DB::table('transaksi')
            ->select('nota.total_belanja', 'nota.tgl_transaksi', 'user.username', 'transaksi.jumlah',
                'transaksi.nama_barang', 'transaksi.harga', 'transaksi.pajak')
            ->join('nota', 'nota.id', '=', 'transaksi.nota_id')
            ->join('user', 'nota.user_id', '=', 'user.id')
            ->where('nota_id', '=', $id)
            ->get();
        $response = [];
        $trasactions = collect($data['transaksi'])->map(function ($trasaction) use ($id) {
            $tr["jumlah"] = $trasaction->jumlah;
            $tr["harga"] = $trasaction->harga;
            $tr["nama_barang"] = $trasaction->nama_barang;
            $tr["subtotal"] = $trasaction->jumlah * $trasaction->harga;
            return $tr;
        })->all();
        $response["transaksi"] = $trasactions;
        $response["id"] = $id;
        $response["username"]= collect(User::where('id',$user_id)->get())->first()->username;
        $response["pajak"] = collect($data['transaksi'])->sum("pajak");
        $response["total_belanja"] = collect($data['transaksi'])->get(0)->total_belanja;
        $response["total_bayar"] = $response["pajak"] + $response["total_belanja"];
        $response["tgl_transaksi"] = $data['transaksi']->get(0)->tgl_transaksi;
        $pdf = PDF::loadview('data-nota', $response);
        return $pdf->download('nota-file-'.$id.'.pdf');
    }

}
