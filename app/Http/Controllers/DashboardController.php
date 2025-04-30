<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Siswa;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    // Sett Admin
    public function index(){
        $guru = Guru::count();
        $siswa = Siswa::count();
        return view('admin.dashboard', compact('guru', 'siswa'));
        // dd(Auth::guard('admin')->user()); // cek apakah admin benar-benar login
    }
    public function updateprofile(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'pass' => 'required|string', // password lama
            'pass1' => 'nullable|string|min:3|confirmed', // password baru
        ]);

        $username = Auth::guard('admin')->user()->username;
        $nama_lengkap = $request->nama_lengkap;
        $password = Auth::guard('admin')->user();

        if (!Hash::check($request->pass, $password->password)) {
            return back()->with('error', 'Password lama salah');
        }

        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
        ];

        if (!empty($request->pass1)) {
            $data['password'] = Hash::make($request->pass1);
        }

        DB::beginTransaction();
        try {
            $update = DB::table('admin')->where('username', $username)->update($data);

            if (!$update) {
                throw new \Exception("Gagal mengupdate data admin.");
            }

            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal mengupdate profil: ' . $e->getMessage());
        }
    }
}
