<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mapel;

class MapelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kode_mapel' => '1001',
                'mapel' => 'Informasi Teknologi'
            ],
            [
                'kode_mapel' => '1002',
                'mapel' => 'Bahasa Indonesia'
            ],
            [
                'kode_mapel' => '1003',
                'mapel' => 'Pendidikan Kewarga Negaraan'
            ],
            [
                'kode_mapel' => '1004',
                'mapel' => 'Olahraga'
            ],
            [
                'kode_mapel' => '1005',
                'mapel' => 'Kesenian dan Budaya'
            ],
            [
                'kode_mapel' => '1006',
                'mapel' => 'Bahasa inggris'
            ],
            [
                'kode_mapel' => '1007',
                'mapel' => 'Aswaja'
            ],
            [
                'kode_mapel' => '1008',
                'mapel' => 'Manajemen'
            ],
        ];
        foreach ($data as $mapel) {
            Mapel::create($mapel);
        }
    }
}
