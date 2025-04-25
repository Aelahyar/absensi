<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\LogAbsensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(Request $request, $kelasId)
    {
        // $kelasId = $request->get('kelas');
        // dd($kelasId);
        $tgl_absen = now()->toDateString();

        $siswas = Siswa::where('id_mkelas', $kelasId)->get();

        if ($siswas->isEmpty()) {
            return back()->with('warning', 'Tidak ada siswa ditemukan di kelas ini.');
        }

        return view('layout.user.absensi', compact('siswas', 'tgl_absen'));
    }

    public function store(Request $request)
    {
        $tgl_absen = $request->input('tgl_absen');
        $data = $request->input('absen');

        // dd($request->all());

        foreach ($request->input('id_siswa') as $idSiswa) {
            $keterangan = $request->input("keterangan.$idSiswa");

            LogAbsensi::create([
                'id_siswa' => $idSiswa,
                'tgl_absen' => $request->input('tgl_absen'),
                'keterangan' => $keterangan,
            ]);
        }

        return redirect()->back()->with('success', 'Absensi berhasil disimpan!');
    }

}
