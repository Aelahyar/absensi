<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
        // dd(Auth::guard('admin')->user()); // cek apakah admin benar-benar login
    }

    public function updateprofile(Request $request){
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'pass' => 'required|string', // password lama
            'pass1' => 'nullable|string|min:3|confirmed', // password baru
        ]);


        $username = Auth::guard('admin')->user()->username;
        $nama_lengkap = $request->nama_lengkap;
        $password = Auth::guard('admin')->user();

        // Verifikasi password lama
        if (!Hash::check($request->pass, $password->password)) {
            return back()->with('error', 'Password lama salah');
        }

        // Siapkan data untuk update
        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
        ];

        // Update password jika password baru diisi
        if (!empty($request->pass1)) {
            $data['password'] = Hash::make($request->pass1);
        }

        $update = DB::table('admin')->where('username', $username)->update($data);
        if ($update) {
            return redirect()->back()->with('success', 'Data berhasil diupdate');
        } else {
            return redirect()->back()->with('error', 'Data gagal diupdate');
        }
    }
}
