<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
session_start();

class adminController extends Controller
{

    public function authLoginAdmin()
    {
        $admin = session()->get('admin');
        if($admin){
            return \redirect('adminDashboard');
        }else{
            return \redirect('admin/adminLogin')->send();
        }
    }
    public function adminLogin()
    {
        return view('adminLogin');
    }
    public function adminDashboard ()
    {
        $this->authLoginAdmin();
        return view('admin.dashboard');
    }
    public function processLogin(Request $request)
    {
        $request->validate(
            [
                'email'=>'required',
                'password'=>'required'
            ],
            [
                'email.required'=>'Trường này không được để trống',
                'password.required'=>'Trường này không được để trống'
            ]
        );
        $email = $request->email;
        $password=md5($request->password);
        $result = DB::table('admin')->where('email',"$email")->where('password',"$password")->first();
        if($result){
            session()->put('admin', $result->full_name);
            return redirect('admin/adminDashboard');
        }else{
            session()->put('message', 'Tài khoản không tồn tại');
            return redirect('admin/adminLogin');
        }
    }
    public function logout()
    {
        $this->authLoginAdmin();
        session()->put('admin', NULL);

        return redirect('admin/adminLogin');
    }
}
