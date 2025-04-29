<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Semester;
use App\Models\JadwalAjar;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class JadwalAjarController extends Controller
{
    public function index()
    {
        $jadwalajar = JadwalAjar::with(['guru', 'mapel', 'kelas'])->get();
        return view('layout.admin.jadwalpel.index', compact('jadwalajar'));
    }
    public function create(){
        $guru = Guru::where('status', 1)->orderBy('nama_guru')->get();
        $kelas = Kelas::select('id_mkelas', 'nama_kelas')->get();
        $mapel = Mapel::select('id_mapel', 'mapel')->get();
        $thajar = TahunAjaran::where('status', 1)->orderBy('tahun_ajaran')->first();
        $semester = Semester::where('status', 1)->orderByDesc('id_semester')->first();
        return view('layout.admin.jadwalpel.create', compact('guru','kelas', 'mapel', 'thajar', 'semester'));
    }
    public function store(Request $request)
    {
        $jadwals = $request->input('jadwals'); // ambil array 'jadwals' dari AJAX

        foreach ($jadwals as $jadwal) {
            JadwalAjar::create([
                'kode_pelajaran'    => $jadwal['kodepel'],
                'id_thajaran'        => $jadwal['thajar'],
                'id_semester'       => $jadwal['semester'],
                'id_guru'           => $jadwal['guru_mapel'],
                'id_mapel'          => $jadwal['mapel'],
                'id_kelas'          => $jadwal['kelas'],
                'hari'              => $jadwal['hari'],
                'jam_mengajar'      => $jadwal['waktu'],
                'jamke'             => $jadwal['jamke'],
            ]);
        }

        return response()->json(['success' => true]);
    }
    public function edit(string $id_mengajar)
    {
        $jadwalajar = JadwalAjar::findOrFail($id_mengajar);
        $guru = Guru::where('status', 1)->orderBy('nama_guru')->get();
        $kelas = Kelas::select('id_mkelas', 'nama_kelas')->get();
        $mapel = Mapel::select('id_mapel', 'mapel')->get();

        // Pisahkan jam_mengajar
        $jam_mengajar = explode('-', $jadwalajar->jam_mengajar);
        $jam_mulai = $jam_mengajar[0] ?? null;
        $jam_selesai = $jam_mengajar[1] ?? null;

        return view('layout.admin.jadwalpel.update', compact('jadwalajar', 'guru', 'mapel', 'kelas', 'jam_mulai', 'jam_selesai'));
    }
    public function update(Request $request, $id_mengajar)
    {
        $request->validate([
            'guru_mapel' => 'required',
            'mapel' => 'required',
            'kelas' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'jamke' => 'required|numeric',
        ]);

        $jadwalajar = JadwalAjar::findOrFail($id_mengajar);

        // Gabungkan jam_mulai dan jam_selesai
        $jam_mengajar = $request->jam_mulai . '-' . $request->jam_selesai;

        $jadwalajar->update([
            'id_guru' => $request->guru_mapel,
            'id_mapel' => $request->mapel,
            'id_kelas' => $request->kelas,
            'hari' => $request->hari,
            'jam_mengajar' => $jam_mengajar,
            'jamke' => $request->jamke,
        ]);

        return redirect()->route('jadwalajar.index')->with('success', 'Data berhasil diupdate!');
    }
    public function destroy($id_mengajar)
    {
        //get post by ID
        $jadwalajar = jadwalAjar::findOrFail($id_mengajar);

        //delete post
        $jadwalajar->delete();

        //redirect to index
        return redirect()->route('jadwalajar.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
