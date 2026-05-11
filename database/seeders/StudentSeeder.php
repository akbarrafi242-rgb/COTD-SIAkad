<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $prodis    = ['Teknik Informatika', 'Sistem Informasi', 'Teknik Industri', 'Manajemen'];
        $angkatans = [2020, 2021, 2022, 2023];

        for ($i = 1; $i <= 200; $i++) {
            DB::table('students')->insert([
                'name'          => 'Mahasiswa ' . $i,
                'email'         => 'mahasiswa' . $i . '@email.com',
                'prodi'         => $prodis[array_rand($prodis)],
                'angkatan'      => $angkatans[array_rand($angkatans)],
                'jenis_kelamin' => rand(0, 1) ? 'L' : 'P',
                'status_lulus'  => rand(0, 3) === 0,
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);
        }
    }
}