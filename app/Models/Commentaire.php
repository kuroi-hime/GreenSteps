<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    protected $fillable = [
        'contenu_commentaire',
        'date_commentaire',
        'statut_commentaire',
        'user_id'
    ];


    /**
     * 
     */
    public function commentaireable()
    {
        return $this->morphTo();
    }

    /**
     * 
     */
    public function writer()
    {
        return $this->belongsTo(User::class);
    }
}
