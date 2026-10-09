<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PrestasiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('prestasi')->insert([
            [
                'id_prestasi' => (string) Str::uuid(),
                'nama_prestasi' => 'Juara 1 Olimpiade Matematika',
                'nama_siswa' => 'Andi Wijaya',
                'tingkat' => 'Nasional',
                'deskripsi' => 'Mendapatkan medali emas pada ajang OSN tingkat nasional.',
                'foto' => 'prestasi/emasOsn.jpg',
                'tahun_ajaran' => '2025/2026',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
