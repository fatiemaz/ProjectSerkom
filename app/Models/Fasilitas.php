<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    use HasUuids;

    protected $table = 'fasilitas';
    protected $primaryKey = 'id_fasilitas';
    protected $keyType = 'string';

    protected $guarded = [];
}
