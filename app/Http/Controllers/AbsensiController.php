<?php

namespace App\Http\Controllers;

use App\Models\LogPresensi;
use App\Models\Siswa;
use App\Models\LogAbsensi;
use Illuminate\Http\Request;
use App\Models\Mengajar;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;

class AbsensiController extends Controller
{
    // Absensi Siswa
    public function index(Request $request, $kelasId)
    {

        $hariIni = Carbon::now()->locale('id')->isoFormat('dddd');
        // $kelasId = $request->get('kelas');
        // dd($kelasId);
        $tgl_absen = now()->toDateString();

        $siswas = Siswa::where('id_mkelas', $kelasId)->get();

        if ($siswas->isEmpty()) {
            return back()->with('warning', 'Tidak ada siswa ditemukan di kelas ini.');
        }

        return view('layout.user.absensi', compact('siswas', 'tgl_absen', 'hariIni'));
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

    // Absensi Guru

    public function indexguru()
    {
        $hariIni = Carbon::now()->locale('id')->isoFormat('dddd'); // Misal: 'Senin', 'Selasa'

        $mengajars = Mengajar::with(['guru', 'mapel', 'kelas'])
            ->where('hari', $hariIni)
            ->orderBy('id_mkelas')
            ->orderBy('waktu')
            ->get()
            ->groupBy('kelas.nama_kelas'); // kelompokkan per kelas

            // dd($mengajars);

        return view('layout.user.absensiguru', compact('mengajars', 'hariIni'));
    }


    public function storeguru(Request $request)
    {
        $dataAbsen = $request->input('absen');
        $tanggalHariIni = Carbon::now()->toDateString();
        $jumlahDisimpan = 0;

        DB::beginTransaction(); // Mulai transaksi database

        try {
            foreach ($dataAbsen as $idMengajar => $status) {
                $absensiExisting = LogPresensi::where('id_mengajar', $idMengajar)
                    ->where('tanggal', $tanggalHariIni)
                    ->first();

                if (!$absensiExisting) {
                    LogPresensi::create([
                        'id_mengajar' => $idMengajar,
                        'status' => $status,
                        'tanggal' => $tanggalHariIni,
                    ]);
                    $jumlahDisimpan++; // Tambah counter kalau berhasil create
                }
            }

            if ($jumlahDisimpan > 0) {
                DB::commit(); // Simpan transaksi
                return redirect()->back()->with('success', 'Absensi guru berhasil disimpan!');
            } else {
                DB::rollBack(); // Tidak ada yang disimpan, rollback
                return redirect()->back()->with('error', 'Semua guru sudah absen hari ini, tidak ada data baru disimpan.');
            }

        } catch (Exception $e) {
            DB::rollBack(); // Ada error, rollback
            return redirect()->back()->with('error', 'Gagal menyimpan absensi: ' . $e->getMessage());
        }
    }

}
