<?php

// namespace Database\Seeders;

// use App\Models\Pengumuman;
// use Illuminate\Database\Seeder;
// use Illuminate\Support\Str;

// class PengumumanSeeder extends Seeder
// {
//     public function run(): void
//     {
//         Pengumuman::create([
//             'id_pengumuman' => (string) Str::uuid(),
//             'judul' => 'Libur Semester Ganjil',
//             'isi' => 'Libur semester ganjil dimulai tanggal 20 Desember.',
//             'tanggal' => now()->toDateString(),
//             'status' => 'Publish',
//             'id_user' => '11111111-1111-1111-1111-111111111111',
//             'created_at' => now(),
//             'updated_at' => now(),
//         ]);
//     }
// }


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PengumumanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pengumuman')->insert([
            [
                'id_pengumuman' => (string) Str::uuid(),
                'judul' => 'Libur Semester Ganjil',
                'isi' => 'Libur semester ganjil dimulai tanggal 20 Desember.',
                'tanggal' => now()->toDateString(),
                'status' => 'Publish',
                'id_user' => '11111111-1111-1111-1111-111111111111',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
