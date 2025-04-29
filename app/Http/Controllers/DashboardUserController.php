<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class DashboardUserController extends Controller
{
    // Sett User
    public function index(){
        return view('user.index');
        // dd(Auth::guard('user')->user()); // cek apakah admin benar-benar login
    }

    public function updateprofile(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'pass' => 'required|string', // password lama
            'pass1' => 'nullable|string|min:3|confirmed', // password baru
        ]);


        $email = Auth::guard('user')->user()->email;
        $name = $request->name;
        $password = Auth::guard('user')->user();

        // Verifikasi password lama
        if (!Hash::check($request->pass, $password->password)) {
            return back()->with('error', 'Password lama salah');
        }

        // Siapkan data untuk update
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Update password jika password baru diisi
        if (!empty($request->pass1)) {
            $data['password'] = Hash::make($request->pass1);
        }

        $update = DB::table('users')->where('email', $email)->update($data);
        if ($update) {
            return redirect()->back()->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->back()->with('error', 'Data gagal diupdate');
        }
    }
}
