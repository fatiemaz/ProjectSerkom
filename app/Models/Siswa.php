<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasUuids;

    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    // public $incrementing = true;
    protected $keyType = 'string';

    protected $guarded = [];

    public function prestasi(): HasMany
    {
        return $this->hasMany(Prestasi::class, 'id_siswa', 'id_siswa');
    }
}
