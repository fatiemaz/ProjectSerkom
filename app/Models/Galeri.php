<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Galeri extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'galeri';
    protected $primaryKey = 'id_galeri';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = [];

    public function uniqueIds(): array
    {
        return ['id_galeri'];
    }
}
