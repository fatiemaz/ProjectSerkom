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
    protected $keyType = 'string';

    protected $guarded = [];

    protected $hidden = [
        'password',
    ];

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
