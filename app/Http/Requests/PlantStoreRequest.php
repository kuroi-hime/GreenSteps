<?php

namespace App\Http\Requests;

// use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Support\Facades\Auth;

class PlantStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; //Auth::user()->role->nom_role == 'admin'
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom_commun' => 'required|string|min:2',
            'nom_scientifique' => 'required|string|min:2',
            'description_plante' => 'required|string|min:10',
            'frequence_arrosage' => 'required|integer|min:0',
            'days_to_recolte' => 'required|integer|min:1',
            'difficulte_plante' => 'required|in:easy,medium,hard', 
            'categorie_id' => 'required|exists:categories,id',
            'height_plante' => 'required|numeric|min:0',
            'min_temp_plante' => 'required|numeric',
            'max_temp_plante' => 'required|numeric|gt:min_temp_plante',
            'sunlight_plante' => 'required|in:full sun,partial shade,full shade',
            'images' => 'required|array|min:1',
            // 'images.*' => 'url',
        ];
    }

    /**
     * 
     */
    public function messages()
    {
        return [
            'nom_commun.required' => 'nom commun obligatoire',
            'nom_commun.min' => 'nom commun ayant plus 2 caractères',
            'nom_scientifique.required' => 'nom scientifique obligatoire',
            'nom_scientifique.min' => 'nom scientifique ayant plus 2 caractères',
            'description_plante.required' => 'description obligatoire',
            'description_plante.min' => 'description ayant plus 10 caractères',
            'frequence_arrosage.required' => 'frequence arrosage obligatoire',
            'frequence_arrosage.integer' => 'frequence arrosage entier',
            'frequence_arrosage.min' => 'frequence arrosage >= 0',
            'days_to_recolte.required' => 'recolte obligatoire',
            'days_to_recolte.integer' => 'recolte entier',
            'days_to_recolte.min' => 'recolte >= 1',
            'difficulte_plante.required' => 'difficulté obligatoire',
            'difficulte_plante.in' => 'easy,medium ou hard', 
            'categorie_id.required' => 'categorie obligatoire',
            'categorie_id.exists' => 'categorie existe',
            'height_plante.required' => 'hauteur obligatoire',
            'height_plante.numeric' => 'hauteur nombre',
            'height_plante.min' => 'hauteur > 0',
            'min_temp_plante.required' => 'min temp obligatoire',
            'min_temp_plante.numeric' => 'min temp nombre',
            'max_temp_plante.required' => 'max temp obligatoire',
            'max_temp_plante.numeric' => 'max temp nombre',
            'max_temp_plante.gt' => 'gt:min_temp_plante',
            'sunlight_plante.required' => 'sunlight obligatoire',
            'sunlight_plante.in' => 'full sun,partial shade,full shade',
            'images.required' => 'images obligatoire',
            'images.array' => 'images array',
            'images.min' => 'images at least 1 image',
        ];
    }
}
