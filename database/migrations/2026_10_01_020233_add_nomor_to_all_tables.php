<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private array $tabel = [
        'user', 'guru', 'siswa', 'ekstrakurikuler',
        'prestasi', 'pengumuman', 'berita', 'galeri',
    ];

    public function up(): void
    {
        foreach ($this->tabel as $t) {
            DB::statement("ALTER TABLE `$t` ADD `nomor` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE");
        }
    }

    public function down(): void
    {
        foreach ($this->tabel as $t) {
            DB::statement("ALTER TABLE `$t` DROP COLUMN `nomor`");
        }
    }
};
