<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogAbsensi;


class RekapController extends Controller
{

    public function index(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        $query = LogAbsensi::with('siswa')
            ->where('keterangan', '!=', 'H');

        if ($start && $end) {
            $query->whereBetween('tgl_absen', [$start, $end]);
        }

        // Tambahkan pengecualian hari Minggu
        $query->whereRaw('DAYOFWEEK(tgl_absen) != 1'); // 1 = Minggu

        // $rekap = $query->orderBy('tgl_absen', 'desc')->get();
        $rekap = LogAbsensi::with(['siswa.kelas'])
        ->where('keterangan', '!=', 'H')
        ->when($start && $end, function ($q) use ($start, $end) {
            $q->whereBetween('tgl_absen', [$start, $end]);
        })
        ->whereRaw('DAYOFWEEK(tgl_absen) != 1') // Kecuali Minggu
        ->get()
        ->sortBy([
            fn($a, $b) => strcmp($a->siswa->kelas->nama_kelas ?? '', $b->siswa->kelas->nama_kelas ?? ''),
            fn($a, $b) => strcmp($a->siswa->nama_siswa ?? '', $b->siswa->nama_siswa ?? ''),
            fn($a, $b) => strtotime($a->tgl_absen) <=> strtotime($b->tgl_absen),
        ]);

            // dd($rekap);
        return view('layout.user.rekapsiswa', compact('rekap', 'start', 'end'));
    }
}
