<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasController extends Controller
{
    //view
    public function index()
    {
        $kelas = Kelas::all();
        return view('layout.admin.kelas', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kd_kelas' => 'required|unique:kelas,kd_kelas',
            'nama_kelas' => 'required'
        ]);

        Kelas::create($request->all());

        return redirect()->back()->with('success', 'Kelas berhasil ditambahkan!');
    }

    public function update(Request $request, $id_mkelas)
    {
        $request->validate([
            'nama_kelas' => 'required'
        ]);

        $kelas = Kelas::findOrFail($id_mkelas);
        $kelas->update(['nama_kelas' => $request->nama_kelas]);

        return redirect()->back()->with('success', 'Kelas berhasil diperbarui!');
    }

    public function destroy($id_mkelas)
    {
        $kelas = Kelas::findOrFail($id_mkelas);
        $kelas->delete();

        return redirect()->back()->with('success', 'Kelas berhasil dihapus!');
    }
}
