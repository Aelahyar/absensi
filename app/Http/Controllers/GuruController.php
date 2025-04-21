<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::all();
        return view('layout.admin.guru', compact('guru'));
    }

        // Simpan data guru baru
        public function store(Request $request)
        {
            $request->validate([
                'nik' => 'required|unique:guru,nik',
                'nama_guru' => 'required|string|max:255',
                'email' => 'required|email|unique:guru,email',
            ]);

            Guru::create([
                'nik' => $request->nik,
                'nama_guru' => $request->nama_guru,
                'email' => $request->email,
                'status' => 'Y',
            ]);

            return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');
        }

        // Update data guru
        public function update(Request $request, $id_guru)
        {
            $guru = Guru::findOrFail($id_guru);

            $request->validate([
                'nik' => 'required|unique:guru,nik,' . $guru->id_guru . ',id_guru',
                'nama_guru' => 'required|string|max:100',
                'email' => 'required|email|unique:guru,email,' . $guru->id_guru . ',id_guru',
                'status' => 'required|in:Y,N',
            ]);

            $guru->update([
                'nik' => $request->nik,
                'nama_guru' => $request->nama_guru,
                'email' => $request->email,
                'status' => $request->status,
            ]);

            return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui.');
        }

        // Hapus data guru
        public function destroy($id_guru)
        {
            $guru = Guru::findOrFail($id_guru);
            $guru->delete();

            return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
        }
}
