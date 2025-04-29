<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mengajar;
use Illuminate\Support\Str;

class MengajarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu'];
        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu', 'Minggu'];
        $totalJadwal = 0;

        // Loop untuk kelas 1 sampai 5
        for ($idKelas = 1; $idKelas <= 5; $idKelas++) {
            foreach ($hariList as $hari) {
                $startHour = 7; // Mulai dari jam 7 pagi
                $jumlahPelajaran = rand(6, 8); // 6-8 jam pelajaran per hari

                for ($jamke = 1; $jamke <= $jumlahPelajaran; $jamke++) {
                    Mengajar::create([
                        'kode' => 'MPL-' . Str::upper(Str::random(5)),
                        'hari' => $hari,
                        'waktu' => sprintf('%02d:00 - %02d:00', $startHour, $startHour + 1),
                        'jamke' => $jamke,
                        'id_guru' => rand(2, 9),
                        'id_mapel' => rand(1, 8),
                        'id_mkelas' => $idKelas, // Sekarang kelas dinamis (1-5)
                        'id_semester' => 1,
                        'id_thajaran' => 1,
                    ]);

                    $startHour++;
                    $totalJadwal++;
                }
            }
        }
    }
}
