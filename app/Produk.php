<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
        protected $table = 'produk';
        protected $fillable=['nama_barang','tgl_masuk','harga','harga_jual','stok','warna','spesifikasi','foto'];

        public function kategori(){
            return $this->belongsTo(Kategori::class);
        }
        public function keranjang(){
            return $this->hasMany(Keranjang::class);
        }
        public function nota(){
            return $this->belongsTo(Nota::class);
        }

}
