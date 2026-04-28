<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jardin extends Model
{
    protected $fillable = [
        'nom_jardin',
        'description_jardin',
        'owner_id',
    ];


    /**
     * Get the owner of the garden
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
