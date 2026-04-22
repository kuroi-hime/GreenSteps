<?php

namespace Database\Seeders;

use App\Models\Categorie;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Succulentes' => 'Plantes grasses comme l\'Echeveria ou l\'Aloe Vera, nécessitant peu d\'arrosage.',
                       'Fougères' => 'Plantes d\'ombre aimant l\'humidité, parfaites pour les salles de bain.',
                       'Aromatiques' => 'Herbes pour la cuisine : Basilic, Menthe et Thym pour vos plats faits maison.',
                       'Tropicales' => 'Végétation luxuriante de jungle comme le Monstera ou le Philodendron.',
                       'Potager' => 'Légumes et petits fruits à cultiver sur un balcon ou dans un jardin.'];

        foreach($categories as $nom => $description)
        {
            Categorie::create(
                ['nom_categorie' => $nom,
                'description_categorie' => $description]
            );
        }
    }
}
