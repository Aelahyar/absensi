<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAjaran;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $data = TahunAjaran::orderBy('id_thajaran', 'desc')->get();
        return view('layout.admin.tahun', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => 'required|string',
        ]);

        TahunAjaran::create([
            'tahun_ajaran' => $request->tahun_ajaran,
            'status' => $request->status ?? 0
        ]);
        return redirect()->back()->with('success', 'Tahun Ajaran ditambahkan.');
    }

    public function update(Request $request, $id_thajaran)
    {
        $ta = TahunAjaran::findOrFail($id_thajaran);
        $ta->tahun_ajaran = $request->tahun_ajaran;
        $ta->status = $request->status; // akan dapat nilai 0 atau 1 sekarang
        $ta->save();
        return redirect()->back()->with('success', 'Data diubah.');
    }

    public function destroy($id_thajaran)
    {
        TahunAjaran::destroy($id_thajaran);
        return redirect()->back()->with('success', 'Data dihapus.');
    }

    public function setStatus($id_thajaran, $status)
    {
        TahunAjaran::where('id_thajaran', $id_thajaran)->update(['status' => $status]);
        return redirect()->back()->with('success', 'Status diperbarui.');
    }

}
