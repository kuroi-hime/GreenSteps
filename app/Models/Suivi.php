<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Suivi extends Pivot
{
    protected $table = 'suivi';
    protected $fillable = ['plante_id', 'jardin_id'];
}
