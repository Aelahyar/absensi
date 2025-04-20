<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        $mapel = Mapel::all();
        return view('layout.admin.mapel', compact('mapel'));
    }

    public function store(Request $request)
    {
        Mapel::create([
            'kode_mapel' => $request->kode_mapel,
            'mapel' => $request->mapel
        ]);

        return redirect()->back()->with('success', 'Mapel berhasil ditambahkan');
    }

    public function update(Request $request, $id_mapel)
    {
        $mapel = Mapel::findOrFail($id_mapel);
        $mapel->update([
            'mapel' => $request->mapel
        ]);

        return redirect()->back()->with('success', 'Mapel berhasil diperbarui');
    }

    public function destroy($id_mapel)
    {
        Mapel::destroy($id_mapel);
        return redirect()->back()->with('success', 'Mapel berhasil dihapus');
    }
}
