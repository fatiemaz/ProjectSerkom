<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasUuids;

    protected $table = 'prestasi';
    protected $primaryKey = 'id_prestasi';
    // public $incrementing = true;
    protected $keyType = 'string';

    protected $guarded = [];
}
