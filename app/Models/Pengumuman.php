<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasUuids;

    protected $table = 'pengumuman';
    protected $primaryKey = 'id_pengumuman';
    // public $incrementing = true;
    protected $keyType = 'string';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
