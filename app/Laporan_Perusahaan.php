<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laporan_Perusahaan extends Model
{
    protected $table = 'laporan_perusahaan';
    protected $fillable=['periode','total_pendapatan'];


    public static function getGrafik(){
 
 
    	$tahun_awal = date('Y') - 5;
    	$tahun_akhir = date('Y');
 
    	$category = [];
 
    	$series[0]['name'] = '1';
    	$series[1]['name'] = '2';
    	
 
 
    	$j = 0;
    	for ($i=$tahun_awal; $i <= $tahun_akhir ; $i++) { 
    		$category[] = $i;
 
    		$series[0]['data'][] = Self::where('nota_id', '=', '1')->where('created_at','like', $i.'%')->count();
    		$series[1]['data'][] = Self::where('nota_id', '=', '2')->where('created_at','like', $i.'%')->count();
    		
    	}
 
 
    	return ['category' => $category, 'series' => $series];
 
 
    }

}
