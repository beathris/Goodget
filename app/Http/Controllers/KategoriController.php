<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    private $pages;
    public function _construct(){
        $this->pages= array();
    }

    public function index(Request $request){
        $title = "Admin-Kategori";
        if($request->has('cari')){
            $kategori = \App\Kategori::where('nama_kategori','LIKE','%'.$request->cari.'%')->get();
        }else{
            
            $kategori = \App\Kategori::all();
        }
        return view('kategori_index', ['kategori'=>$kategori], ['title'=>$title]);
    }

    public function kategoriAddPost(){
        $title = "Add New Kategori";
        $kategori = \App\Kategori::all();
        return view('kategori_add', ['kategori'=> $kategori], ['title'=>$title]);

    }
    public function kategoriAddSave(Request $request){
        \App\Kategori::create($request->all());
        return redirect('/admin/kategori')->with('Sukses', 'Data berhasil ditambah');
    }

    public function kategoriEditPost($id){
        $kategori = \App\Kategori::find($id);
        return view('kategori_edit',['kategori'=>$kategori]);

    }

    public function kategoriEditPostSave(Request $request, $id){
        $kategori = \App\Kategori::find($id);
        $kategori->update($request->all());
        return redirect('/admin/kategori');
    }
    public function kategoriDeletePost($id){
        $kategori = \App\Kategori::find($id);
        $kategori->delete($kategori);
        return redirect('/admin/kategori');
    }
}
