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

    public function update(Request $request, $id)
    {
        $mapel = Mapel::findOrFail($id);
        $mapel->update([
            'mapel' => $request->mapel
        ]);

        return redirect()->back()->with('success', 'Mapel berhasil diperbarui');
    }

    public function destroy($id)
    {
        Mapel::destroy($id);
        return redirect()->back()->with('success', 'Mapel berhasil dihapus');
    }
}
