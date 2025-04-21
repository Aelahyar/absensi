<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kepsek;

class KepsekController extends Controller
{
    public function index()
    {
        $kepsek = Kepsek::all();
        return view('layout.admin.kepsek', compact('kepsek'));
    }

        // Simpan data guru baru
        public function store(Request $request)
        {
            $request->validate([
                'nik' => 'required|unique:kepseks,nik',
                'nama_kepsek' => 'required|string|max:100',
                'email' => 'required|email|unique:kepseks,email',
            ]);

            Kepsek::create([
                'nik' => $request->nik,
                'nama_kepsek' => $request->nama_kepsek,
                'email' => $request->email,
                'status' => 'Y',
            ]);

            return redirect()->route('kepsek.index')->with('success', 'Data Kepala Sekolah berhasil ditambahkan.');
        }

        // Update data guru
        public function update(Request $request, $id_kepsek)
        {
            $kepsek = Kepsek::findOrFail($id_kepsek);

            $request->validate([
                'nik' => 'required|unique:kepseks,nik,' . $kepsek->id_kepsek . ',id_kepsek',
                'nama_kepsek' => 'required|string|max:100',
                'email' => 'required|email|unique:kepseks,email,' . $kepsek->id_kepsek . ',id_kepsek',
                'status' => 'required|in:Y,N',
            ]);

            $kepsek->update([
                'nik' => $request->nik,
                'nama_kepsek' => $request->nama_kepsek,
                'email' => $request->email,
                'status' => $request->status,
            ]);

            return redirect()->route('kepsek.index')->with('success', 'Data Kepala Sekolah berhasil diperbarui.');
        }

        // Hapus data guru
        public function destroy($id_kepsek)
        {
            $kepsek = Kepsek::findOrFail($id_kepsek);
            $kepsek->delete();

            return redirect()->route('kepsek.index')->with('success', 'Data Kepala Sekolah berhasil dihapus.');
        }
}
