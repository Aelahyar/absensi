<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if(Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/dashboard_user');
            // return redirect()->route('admin.dashboard');
        } else {
            return redirect('/')->with(['warning' => 'Email / Password Salah']);
        }
    }

    public function logout(){
        if(Auth::guard('user')->check()){
            Auth::guard('user')->logout();
            return redirect('/');
        }
    }

    public function logoutadmin(){
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
            return redirect('/admin');
        }
    }

    public function loginadmin(Request $request)
    {
        // $pass = '123';
        // echo Hash::make($pass);

        if(Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
            // return view('admin.dashboard');
            return redirect('/dashboardadmin');
        } else {
            return redirect('/admin')->with(['warning' => 'Username / Password Salah']);
        }
    }
}
