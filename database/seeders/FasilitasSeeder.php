<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama'      => 'Perpustakaan',
                'deskripsi' => 'Ruang baca nyaman dengan koleksi buku pelajaran, referensi, dan fiksi untuk menunjang minat baca siswa.',
                'foto'      => 'fasilitas/perpustakaan.jpg',
            ],
            [
                'nama'      => 'Laboratorium Komputer',
                'deskripsi' => 'Dilengkapi komputer dan jaringan internet untuk praktik TIK dan pembelajaran berbasis digital.',
                'foto'      => 'fasilitas/lab_komputer.jpg',
            ],
            [
                'nama'      => 'Laboratorium IPA',
                'deskripsi' => 'Tempat praktik fisika, kimia, dan biologi dengan peralatan lengkap dan standar keamanan yang baik.',
                'foto'      => 'fasilitas/lab_ipa.jpg',
            ],
            [
                'nama'      => 'Lapangan Olahraga',
                'deskripsi' => 'Lapangan serbaguna untuk futsal, basket, voli, serta upacara bendera dan kegiatan olahraga.',
                'foto'      => 'fasilitas/lapangan.jpg',
            ],
            [
                'nama'      => 'Masjid Sekolah',
                'deskripsi' => 'Sarana ibadah dan kegiatan keagamaan yang bersih dan nyaman bagi seluruh warga sekolah.',
                'foto'      => 'fasilitas/masjid.jpg',
            ],
            [
                'nama'      => 'Ruang Kelas',
                'deskripsi' => 'Ruang kelas luas, bersih, dan berpencahayaan baik, dilengkapi proyektor untuk belajar interaktif.',
                'foto'      => 'fasilitas/ruang_kelas.jpg',
            ],
        ];

        foreach ($data as $item) {
            // Lewati jika nama sudah ada, supaya seeder aman dijalankan berulang
            if (DB::table('fasilitas')->where('nama', $item['nama'])->exists()) {
                continue;
            }

            DB::table('fasilitas')->insert([
                'id_fasilitas' => (string) Str::uuid(),
                'nama'         => $item['nama'],
                'deskripsi'    => $item['deskripsi'],
                'foto'         => $item['foto'],
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
