<?php

namespace App\Http\Requests;

// use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CategorieStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->role->nom_role == 'admin';
    }

    /**
     * Foncion pour normaliser les inputs (améliore UX)
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'nom_categorie' => ucwords(strtolower($this->nom_categorie)),
            'description_categorie' => collect(explode('. ', strtolower(str_replace('.', '. ', $this->description_categorie))))
            ->map(fn($s) => ucfirst($s))
            ->implode('. ')
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom_categorie' => 'required|string|min:1|unique:categories,nom_categorie',
            'description_categorie' => 'required|string|min:10'
        ];
    }

    /**
     * 
     */
    public function messages(): array 
    {
        return [
            'nom_categorie.required' => 'Le nom est obligatoire.',
            'nom_categorie.min' => 'Vous devez avoir au moins un caractère.',
            'nom_categorie.unique' => 'Ce nom existe déjà.',
            'nom_categorie.lowercase' => 'Le nom doit être écrit en miniscule.',
            'description_categorie.required' => 'Veuillez fournir la description aussi.',
            'description_categorie.min' => 'La description est courte.',
        ];
    }
}
