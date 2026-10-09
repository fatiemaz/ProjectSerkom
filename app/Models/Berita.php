<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Berita extends Model
{
    use HasUuids;

    protected $table = 'berita';
    protected $primaryKey = 'id_berita';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function uniqueIds(): array
    {
        return ['id_berita'];  // menentukan kolom uuid
    }

    // relasi ke model user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // membuat slug otomatis
    protected static function booted()
    {
        static::saving(function ($berita) {
            // Hanya jalankan jika judul diisi dan (slug kosong atau judul baru saja diubah)
            if (!empty($berita->judul) && (empty($berita->slug) || $berita->isDirty('judul'))) {
                $base = Str::slug($berita->judul) ?: 'berita';
                $slug = $base;
                $i = 2;

                while (static::where('slug', $slug)
                    ->when($berita->exists, fn ($q) => $q->where($berita->getKeyName(), '!=', $berita->getKey()))
                    ->exists()) {
                    $slug = $base . '-' . $i++;  
                }

                $berita->slug = $slug;
            }
        });
    }
}
