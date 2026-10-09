<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Profile extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'profile';
    protected $primaryKey = 'id_profile';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function uniqueIds(): array
    {
        return ['id_profile'];
    }
}
