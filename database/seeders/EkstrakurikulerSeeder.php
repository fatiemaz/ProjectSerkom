<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EkstrakurikulerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ekstrakurikuler')->insert([
            [
                'id_ekskul' => (string) Str::uuid(),
                'nama_ekskul' => 'Pramuka',
                'pembina' => 'Budi Santoso, S.Pd',
                'jadwal_latihan' => 'Jumat, 15:00 WIB',
                'deskripsi' => 'Kegiatan kepramukaan untuk membentuk karakter disiplin.',
                'gambar' => 'ekstrakurikuler/pramuka.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
