<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plante extends Model{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nom_commun',
        'nom_scientifique',
        'description_plante',
        'frequence_arrosage',
        'days_to_recolte',
        'difficulte_plante',
        'categorie_id',
        'height_plante',
        'min_temp_plante',
        'max_temp_plante',
        'sunlight_plante',
    ];

    /**
     * Get the plant's category
     */
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    /**
     * 
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * 
     */
    public function suivis()
    {
        return $this->hasMany(Suivi::class);
    }

    /**
     * 
     */
    public function etapes()
    {
        return $this->hasMany(Etape::class);
    }
}