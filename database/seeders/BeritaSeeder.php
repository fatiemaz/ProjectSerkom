<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('berita')->insert([
            [
                'id_berita' => (string) Str::uuid(),
                'judul' => 'Kegiatan Upacara Bendera HUT RI',
                'slug' => 'kegiatan-upacara-bendera-hut-ri',
                'isi' => 'Seluruh siswa dan guru mengikuti upacara dengan khidmat.',
                'tanggal' => now()->toDateString(),
                'gambar' => 'berita/upacara.jpg',
                'status' => 'Publish',
                'id_user' => '11111111-1111-1111-1111-111111111111',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
