<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    //
    public function login()
    {
        // gọi view hiện hị form đăng nhập
        return view('Admin.login');
    }
    public function post_login(Request $request)
    {
        // code thực hiện đăng nhập
        $login_data = [
            'email' => $request->email,
            'password' => $request->password
            ];
            //dd($login_data);
            $check_login = Auth::guard('admin')->attempt($login_data);
            
            if(! $check_login){
            return redirect()->back()->with('error','Đăng nhập không thành công vui lòng thử lại');
            }
            return redirect()->route('admin.index');
    }
}
