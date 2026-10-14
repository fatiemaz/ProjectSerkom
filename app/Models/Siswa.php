<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * FILE: app/Models/Siswa.php
 */
class Siswa extends Model
{
    use HasUuids;

    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    // Kolom UUID (wajib karena primary key bukan "id")
    public function uniqueIds(): array
    {
        return ['id_siswa'];
    }

    // Siswa milik satu kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    /**
     * NISN disamarkan untuk halaman publik, contoh: 00123*****789
     * Dipanggil di view lewat $siswa->nisn_samar
     */
    public function getNisnSamarAttribute(): string
    {
        if (empty($this->nisn)) {
            return '-';
        }

        $nisn = (string) $this->nisn;

        // NISN terlalu pendek: samarkan seluruhnya
        if (strlen($nisn) <= 6) {
            return str_repeat('*', strlen($nisn));
        }

        // Tampilkan 3 digit awal dan 3 digit akhir
        return substr($nisn, 0, 3)
            . str_repeat('*', strlen($nisn) - 6)
            . substr($nisn, -3);
    }
}
