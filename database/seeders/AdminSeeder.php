<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admin')->insert([
            'nama_lengkap' => 'Administrator',
            'username'     => 'admin',
            'password'     => Hash::make('123'), // password terenkripsi
            'aktif'        => 'Y',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);
    }
}
