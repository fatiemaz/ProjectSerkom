<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasUuids;

    protected $table = 'guru';
    protected $primaryKey = 'id_guru';
    // public $incrementing = true;
    protected $keyType = 'string';

    protected $guarded = [];
}
