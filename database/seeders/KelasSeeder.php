<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelas::create([
            'kd_kelas' => 'KLS001',
            'nama_kelas' => 'VII A'
        ]);
        Kelas::create([
            'kd_kelas' => 'KLS002',
            'nama_kelas' => 'VII B'
        ]);
        Kelas::create([
            'kd_kelas' => 'KLS003',
            'nama_kelas' => 'VII C'
        ]);
        Kelas::create([
            'kd_kelas' => 'KLS004',
            'nama_kelas' => 'VII D'
        ]);
        Kelas::create([
            'kd_kelas' => 'KLS005',
            'nama_kelas' => 'VII E'
        ]);
    }
}
