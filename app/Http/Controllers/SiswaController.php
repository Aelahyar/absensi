<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;
use Exception;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::with('kelas')->get(); // contoh relasi
        $kelas = Kelas::all(); // <-- ini penting
        return view('layout.admin.siswa', compact('siswa', 'kelas'));
    }

    // Simpan data siswa baru
    public function store(Request $request)
    {

        DB::beginTransaction(); // Mulai transaksi database

        try {

            $request->validate([
                'nis' => 'required|unique:siswas,nis',
                'nama_siswa' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tgl_lahir' => 'required|date',
                'jk' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'status' => 'required|in:Y,N',
                'pndk' => 'required|string|max:255'
            ]);

            Siswa::create([
                'nis' => $request->nis,
                'nama_siswa' => $request->nama_siswa,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'jk' => $request->jk,
                'alamat' => $request->alamat,
                'id_mkelas' => $request->id_mkelas,
                'pndk' => $request->pndk,
                'status' => 'Y'
            ]);

            DB::commit();
            return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');

        } catch (Exception $e) {
            DB::rollBack(); // Ada error, rollback
            return redirect()->back()->with('error', 'Gagal menyimpan Data siswa: ' . $e->getMessage());
        }
    }

    // Update data siswa
    // public function update(Request $request, $id_siswa)
    // {
    //     $siswa = Siswa::findOrFail($id_siswa);

    //     $request->validate([
    //         'nis' => 'nullable|unique:siswas,nis',
    //         'nama_siswa' => 'nullable|string|max:255',
    //         'tempat_lahir' => 'nullable|string|max:255',
    //         'tgl_lahir' => 'nullable|date',
    //         'jk' => 'nullable|string|max:255',
    //         'alamat' => 'nullable|string|max:255',
    //         'status' => 'nullable|in:Y,N'
    //     ]);

    //     $siswa->update([
    //         'nis' => $request->nis,
    //         'nama_siswa' => $request->nama_siswa,
    //         'tempat_lahir' => $request->tempat_lahir,
    //         'tgl_lahir' => $request->tgl_lahir,
    //         'jk' => $request->jk,
    //         'alamat' => $request->alamat,
    //         'th_angkatan' => $request->th_angkatan,
    //         'id_mkelas' => $request->id_mkelas,
    //         'status' => 'Y',
    //     ]);

    //     return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    // }

        public function update(Request $request, $id_siswa)
    {
        $siswa = Siswa::findOrFail($id_siswa);

        $request->validate([
            'nis' => 'nullable|unique:siswas,nis,' . $id_siswa . ',id_siswa',
            'nama_siswa' => 'nullable|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'jk' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'id_mkelas' => 'nullable|exists:kelas,id_mkelas',
            'status' => 'nullable|in:Y,N',
            'pndk' => 'nullable|string|max:255'
        ]);

        // Ambil hanya input yang tidak null
        $data = array_filter($request->only([
            'nis', 'nama_siswa', 'tempat_lahir', 'tgl_lahir',
            'jk', 'alamat', 'id_mkelas', 'status', 'pndk'
        ]), function ($value) {
            return !is_null($value);
        });

        $siswa->update($data);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }


    // Hapus data siswa
    public function destroy($id_siswa)
    {
        $siswa = Siswa::findOrFail($id_siswa);
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
