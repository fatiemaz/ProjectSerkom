<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasUuids;

    protected $table = 'profile';
    protected $primaryKey = 'id_profile';
    // public $incrementing = true;
    protected $keyType = 'string';

    protected $guarded = [];
}
