<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TahunAjaran;

class ThajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'tahun_ajaran' => '2023/2024',
                'status' => '1'
            ],
            [
                'tahun_ajaran' => '2024/2025',
                'status' => '1'
            ],
            [
                'tahun_ajaran' => '2025/2026',
                'status' => '1'
            ],
            [
                'tahun_ajaran' => '2026/2027',
                'status' => '1'
            ]
        ];
        foreach ($data as $semester) {
            TahunAjaran::create($semester);
        }
    }
}
