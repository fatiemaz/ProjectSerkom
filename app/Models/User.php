<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasUuids;

    protected $table = 'user';
    protected $primaryKey = 'id_user';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    protected $hidden = [
        'password',
    ];

    // Menentukan kolom UUID (wajib karena PK bukan "id")
    public function uniqueIds(): array
    {
        return ['id_user'];
    }

    // ===== Helper role & status (dipakai BeritaPolicy) =====
    public function isAdmin(): bool
    {
        return strtolower($this->role) === 'admin';
    }

    public function isOperator(): bool
    {
        return strtolower($this->role) === 'operator';
    }

    public function isActive(): bool
    {
        return strtolower($this->status) === 'aktif';
    }

    // ===== Relasi =====
    public function pengumuman()
    {
        return $this->hasMany(Pengumuman::class, 'id_user', 'id_user');
    }

    public function berita()
    {
        return $this->hasMany(Berita::class, 'id_user', 'id_user');
    }

    public function profil()
    {
        return $this->hasOne(ProfileUser::class, 'id_user', 'id_user');
    }
}
