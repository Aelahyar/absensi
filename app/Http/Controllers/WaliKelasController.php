<?php

namespace App\Http\Controllers;

use App\Models\WaliKelas;
use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;

class WaliKelasController extends Controller
{
    public function index()
    {
        $data = WaliKelas::with(['guru', 'kelas'])->orderByDesc('id_mkelas')->get();
        $guru = Guru::all();
        $kelas = Kelas::orderBy('id_mkelas')->get();

        return view('layout.admin.walikelas', compact('data', 'guru', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'wakel' => 'required',
            'kelas' => 'required',
        ]);

        WaliKelas::create([
            'id_guru' => $request->wakel,
            'id_mkelas' => $request->kelas,
        ]);

        return redirect()->route('walikelas.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'wakel' => 'required',
            'kelas' => 'required',
        ]);

        $wali = WaliKelas::findOrFail($id);
        $wali->update([
            'id_guru' => $request->wakel,
            'id_mkelas' => $request->kelas,
        ]);

        return redirect()->route('walikelas.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        WaliKelas::destroy($id);
        return redirect()->route('walikelas.index')->with('success', 'Data berhasil dihapus');
    }
}
