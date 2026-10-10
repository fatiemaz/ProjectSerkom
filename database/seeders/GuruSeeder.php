<?php

// namespace Database\Seeders;

// use App\Models\Guru;
// use Illuminate\Database\Seeder;
// use Illuminate\Support\Str;

// class GuruSeeder extends Seeder
// {
//     public function run(): void
//     {
//         Guru::create([
//             'id_guru' => (string) Str::uuid(),
//             'nama_guru' => 'Budi Santoso, S.Pd',
//             'nip' => '19850101201001',
//             'mapel' => 'Matematika',
//             'jabatan' => 'Guru Mapel',
//             'foto' => 'budi.jpg',
//             'created_at' => now(),
//             'updated_at' => now(),
//         ]);
//     }
// }


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('guru')->insert([
            [
                'id_guru' => (string) Str::uuid(),
                'nama_guru' => 'Budi Santoso, S.Pd',
                'nip' => '19850101201001',
                'mapel' => 'Matematika',
                'jabatan' => 'Guru Mapel',
                'foto' => 'guru/jin.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_guru' => (string) Str::uuid(),
                'nama_guru' => 'Siti Nurhaliza, S.E',
                'nip' => '19900202201502',
                'mapel' => NULL,
                'jabatan' => 'Tenaga Kependidikan',
                'foto' => 'guru/guruc.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
