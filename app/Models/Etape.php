<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etape extends Model
{
    protected $fillable = [
        'ordre_etape',
        'instructions_etape',
        'plante_id',
    ];
}
