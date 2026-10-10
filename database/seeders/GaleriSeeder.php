<?php

// namespace Database\Seeders;

// use App\Models\Galeri;
// use Illuminate\Database\Seeder;
// use Illuminate\Support\Str;

// class GaleriSeeder extends Seeder
// {
//     public function run(): void
//     {
//         Galeri::create([
//             'id_galeri' => (string) Str::uuid(),
//             'judul' => 'Pentas Seni 2026',
//             'keterangan' => 'Dokumentasi acara penutupan pentas seni.',
//             'file' => 'pensi.jpg',
//             'kategori' => 'Foto',
//             'tanggal' => now()->toDateString(),
//             'created_at' => now(),
//             'updated_at' => now(),
//         ]);
//     }
// }


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('galeri')->insert([
            [
                'id_galeri' => (string) Str::uuid(),
                'judul' => 'Pentas Seni 2026',
                'keterangan' => 'Dokumentasi acara penutupan pentas seni.',
                'file' => 'galeri/pensi.jpg',
                'kategori' => 'Foto',
                'tanggal' => now()->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
