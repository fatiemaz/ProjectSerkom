<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasUuids;

    protected $table = 'galeri';
    protected $primaryKey = 'id_galeri';
    // public $incrementing = true;
    protected $keyType = 'string';

    protected $guarded = [];
}
