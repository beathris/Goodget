<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiDashboardController extends Controller
{
    public function __construct(){}
    public function getLaporanPendapatan(){
        $result = DB::select("SELECT DATE_FORMAT(tgl_beli, '%Y-%m') AS tgl, SUM(total_belanja) AS total
         FROM nota GROUP BY DATE_FORMAT(tgl_beli, '%Y-%m') ORDER BY tgl_beli ASC",[]);
         return response($result);
    }
}
