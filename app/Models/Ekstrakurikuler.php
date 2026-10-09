<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Ekstrakurikuler extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'ekstrakurikuler';
    protected $primaryKey = 'id_ekskul';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function uniqueIds(): array
    {
        return ['id_ekskul'];
    }
}
