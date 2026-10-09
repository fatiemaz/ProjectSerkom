<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('profile')->insert([
            'id_profile' => (string) Str::uuid(),
            'nama_sekolah' => 'SMPN 1 Mangunreja',
            'kepala_sekolah' => 'Dr. H. Ahmad Dahlan, M.Pd',
            'foto' => 'profile/sekolah.jpg',
            'logo' => 'profile/logo.png',
            'npsn' => '20101234',
            'alamat' => 'Jl. Pendidikan No. 1, Jakarta Central',
            'kontak' => '0211234567',
            'visi' => 'Menjadi sekolah unggulan berkarakter dan berprestasi.',
            'misi' => 'Meningkatkan mutu pendidikan berbasis teknologi dan moral.',
            'tahun_berdiri' => 1995,
            'deskripsi' => 'Sekolah menengah atas terbaik dengan berbagai fasilitas modern.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
