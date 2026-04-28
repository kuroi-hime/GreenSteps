<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['path_image'];

    /**
     * 
     */
    public function Imageable()
    {
        return $this->morphTo();
    }
}
