<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Prestasi extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'prestasi';
    protected $primaryKey = 'id_prestasi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function uniqueIds(): array
    {
        return ['id_prestasi'];
    }
}
