<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $daftarKelas = ['VII A', 'VII B', 'VIII A', 'VIII B', 'IX A', 'IX B'];

        foreach ($daftarKelas as $nama) {
            Kelas::firstOrCreate(['nama_kelas' => $nama]);
        }
    }
}
