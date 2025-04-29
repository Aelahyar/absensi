<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Guru;

class GuruSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nik' => '1001',
                'nama_guru' => 'Ahmad Fauzi',
                'email' => 'example1@gmail.com',
                'status' => 'Y'
            ],
            [
                'nik' => '1002',
                'nama_guru' => 'Rina Apriani',
                'email' => 'example2@gmail.com',
                'status' => 'Y'
            ],
            [
                'nik' => '1003',
                'nama_guru' => 'Dimas Prasetyo',
                'email' => 'example3@gmail.com',
                'status' => 'Y'
            ],
            [
                'nik' => '1004',
                'nama_guru' => 'Andika Prasetyo',
                'email' => 'example4@gmail.com',
                'status' => 'Y'
            ],
            [
                'nik' => '1005',
                'nama_guru' => 'Dimas Handoko',
                'email' => 'example5@gmail.com',
                'status' => 'Y'
            ],
            [
                'nik' => '1006',
                'nama_guru' => 'Aisyah',
                'email' => 'example6@gmail.com',
                'status' => 'Y'
            ],
            [
                'nik' => '1007',
                'nama_guru' => 'Fatimah',
                'email' => 'example7@gmail.com',
                'status' => 'Y'
            ],
            [
                'nik' => '1008',
                'nama_guru' => 'Hasan Bisri',
                'email' => 'example8@gmail.com',
                'status' => 'Y'
            ],
            [
                'nik' => '1009',
                'nama_guru' => 'Hasan Bisri',
                'email' => 'example9@gmail.com',
                'status' => 'Y'
            ],
        ];
        foreach ($data as $guru) {
            Guru::create($guru);
        }
    }
}
