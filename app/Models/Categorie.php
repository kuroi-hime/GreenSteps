<?php
namespace App\Models;

use App\Models\Suivi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Categorie extends Model
{
    protected $fillable = [
        'nom_categorie',
        'description_categorie'
    ];

    /**
     * Une catégorie a plusieures plantes.
     * @return: relation eloquent de type HasMany 
     */
    public function plantes()
    {
        return $this->hasMany(Plante::class);
    }

    /**
     * 
     */
    // public function isActive()
    // {
    //     return DB::table('categories')
    //                    ->join('plantes', 'categories.id', '=', 'plantes.categorie_id')
    //                    ->join('suivi', 'plantes.id', '=', 'plante_id')
    //                    ->where('categories.id', $this->id)
    //                    ->count() ? 'Active': 'Inactive';
    // }

    /**
     * 
     */
    public function suivis()
    {
        return $this->hasManyThrough(
            Suivi::class, 
            Plante::class,
            'categorie_id', // Clé étrangère sur la table plantes
            'plante_id',    // Clé étrangère sur la table suivi
            'id',           // Clé locale sur la table categories
            'id'            // Clé locale sur la table plantes
        );
    }

}
