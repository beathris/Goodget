<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function __construct() {}

    public function login() {
        $data['title'] = "Login - Goodget";
        return view('login_page', $data);
    }

    public function loginAction(Request $request) {
        $method = $request->method();
        if($method == "POST") {
            $result = DB::selectOne("SELECT u.id, u.username, u.status, r.nama AS role FROM user AS u RIGHT JOIN role AS r ON u.role_id = r.id WHERE u.email=? AND u.password=?", [
                $request->input('email'),
                $request->input('password')
            ]);
            if($result->role == "Manager") {
                $request->session()->put('s_id', $result->id);
                $request->session()->put('s_username', $result->username);
                $request->session()->put('s_role', $result->role);
                $request->session()->put('s_status', $result->status);

                return redirect('/admin');
            }else if($result->role == "Employee") {
                $request->session()->put('s_id', $result->id);
                $request->session()->put('s_username', $result->username);
                $request->session()->put('s_role', $result->role);
                $request->session()->put('s_status', $result->status);

                return redirect('/employee');
            }else if($result->role == "User") {
                $request->session()->put('s_id', $result->id);
                $request->session()->put('s_username', $result->username);
                $request->session()->put('s_role', $result->role);
                $request->session()->put('s_status', $result->status);

                return redirect('/produk');
            }else {
                return redirect('/login');
            }
        }else {
            return redirect('/login');
        }
    }
}
