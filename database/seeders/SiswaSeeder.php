<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $kelas7a = Kelas::firstOrCreate(['nama_kelas' => 'VII A']);
        $kelas7b = Kelas::firstOrCreate(['nama_kelas' => 'VII B']);
        DB::table('siswa')->insert([
            [
            'id_siswa' => (string) Str::uuid(),
                'nisn' => '0057654321',
                'nama_siswa' => 'Rina Lestari',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => 2024,
                'id_kelas'      => $kelas7a->id_kelas,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_siswa' => (string) Str::uuid(),
                'nisn' => '005098765443',
                'nama_siswa' => 'Lestari',
                'jenis_kelamin' => 'Perempuan',
                'tahun_masuk' => 2024,
                'id_kelas'      => $kelas7b->id_kelas,
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ]);
    }
}
