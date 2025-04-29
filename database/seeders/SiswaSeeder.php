<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Siswa;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $kelasId = 1; // pastikan id_mkelas=1 sudah ada di tabel 'kelas'

        $data = [
            [
                'nis' => '1001',
                'nama_siswa' => 'Ahmad Fauzi',
                'tempat_lahir' => 'Bandung',
                'tgl_lahir' => '2007-03-21',
                'jk' => 'Laki-laki',
                'alamat' => 'Jl. Merdeka No. 1',
                'th_angkatan' => '2022',
                'status' => 'Y',
                'pndk' => 'Non Pondok',
                'id_mkelas' => $kelasId,
            ],
            [
                'nis' => '1002',
                'nama_siswa' => 'Rina Apriani',
                'tempat_lahir' => 'Jakarta',
                'tgl_lahir' => '2008-01-15',
                'jk' => 'Perempuan',
                'alamat' => 'Jl. Soekarno Hatta',
                'th_angkatan' => '2022',
                'status' => 'Y',
                'pndk' => 'Non Pondok',
                'id_mkelas' => $kelasId,
            ],
            [
                'nis' => '1003',
                'nama_siswa' => 'Dimas Prasetyo',
                'tempat_lahir' => 'Surabaya',
                'tgl_lahir' => '2007-07-09',
                'jk' => 'Laki-laki',
                'alamat' => 'Jl. Kalimantan No. 3',
                'th_angkatan' => '2022',
                'status' => 'Y',
                'pndk' => 'Non Pondok',
                'id_mkelas' => $kelasId,
            ],
        ];
        foreach ($data as $siswa) {
            Siswa::create($siswa);
        }
    }
}
