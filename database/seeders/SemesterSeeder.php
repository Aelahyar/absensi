<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Semester;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'semester' => 'I',
                'status' => '1'
            ],
            [
                'semester' => 'II',
                'status' => '0'
            ]
        ];
        foreach ($data as $semester) {
            Semester::create($semester);
        }
    }
}
