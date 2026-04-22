<?php

namespace Database\Factories;

use App\Models\Plante;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Plante>
 */
class PlanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $difficulties = ['easy', 'medium', 'hard'];
        $categories = Categorie::all();

        return [
            // without true it returns an array instead of a string
            'nom_commun' => fake()->words(random_int(1, 2), true),
            'nom_scientifique' => fake()->words(random_int(1, 3), true),
            'description_plante' => fake()->sentences(random_int(1, 3), true),
            'frequence_arrosage' => random_int(0, 5),
            'days_to_recolte' => random_int(30, 365),
            'difficulte_plante' => $difficulties[random_int(0, 2)],
            'categorie_id' => $categories[random_int(0, count($categories)-1)]->id,
        ];
    }
}
