<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plante extends Model{
    use HasFactory;

    protected $fillable = [
        'nom_commun',
        'nom_scientifique',
        'description_plante',
        'frequence_arrosage',
        'days_to_recolte',
        'difficulte_plante',
        'categorie_id',
    ];

    /**
     * Get the plant's category
     */
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
}