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
        if(Auth::guard('guru')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/dashboard');
        } else {
            return redirect('/')->with(['warning' => 'Email / Password Salah']);
        }
    }

    public function loginadmin(Request $request)
    {
        // $pass = '123';
        // echo Hash::make($pass);

        if(Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/dashboard');
        } else {
            return redirect('/admin')->with(['warning' => 'Email / Password Salah']);
        }
    }
}
