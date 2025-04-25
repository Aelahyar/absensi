<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Logout guard admin agar tidak bentrok
        Auth::guard('admin')->logout();

        if(Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/dashboarduser');
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
        // Logout guard user agar tidak bentrok
        Auth::guard('user')->logout();

        // $pass = '123';
        // echo Hash::make($pass);

        if(Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
            // return view('admin.dashboard');
            return redirect('/dashboardadmin')->with('success', 'Berhasil login sebagai admin!');
        } else {
            return redirect('/admin')->with('warning', 'Username / Password Salah');

        }
    }

    // public function gantiPassword(Request $request)
    // {
    //     $request->validate([
    //         'pass' => 'required',
    //         'pass1' => 'required|min:6|confirmed',
    //     ]);

    //     $admin = Auth::guard('admin')->user();

    //     if (!Hash::check($request->pass, $admin->password)) {
    //         return back()->with('error', 'Password lama tidak cocok.');
    //     }

    //     // $admin->update([
    //     //     'password' => Hash::make($request->pass1),
    //     // ]);z

    //     return back()->with('success', 'Password berhasil diubah.');
    // }
}
