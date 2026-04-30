<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
// use App\Http\Requests\PlantStoreRequest;
use App\Models\Categorie;
use App\Models\Plante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plantes = Plante::with('images', 'categorie')->paginate(4);
        $categories = Categorie::all();

        $user = Auth::user();
        
        if($user)
        {
            if($user->role->nom_role === 'admin')
                return view('plantes.index', compact('plantes', 'categories'));
        }

        return view('plantes.client.index', compact('plantes')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('plantes.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_commun'          => 'required|string|max:255',
            'nom_scientifique'    => 'required|string|max:255',
            'description_plante'  => 'required|string',
            'categorie_id'        => 'required|exists:categories,id',
            'difficulte_plante'   => 'required|in:easy,medium,hard',
            'sunlight_plante'     => 'required|in:full sun,partial shade,full shade',
            'frequence_arrosage' => 'required|integer|min:0',
            'min_temp_plante'     => 'nullable|numeric',
            'max_temp_plante'     => 'required|numeric',
            'height_plante'       => 'required|numeric|min:0',
            'days_to_recolte'      => 'required|integer|min:1',
            'images'              => 'sometimes|array|min:1',
            // 'images.*'            => 'url',
            'etapes'              => 'required|array',
            'etapes.*'            => 'string',
        ]);

        // Create the plant
        $plante = Plante::create([
            'nom_commun'          => $validated['nom_commun'],
            'nom_scientifique'    => $validated['nom_scientifique']    ?? null,
            'description_plante'  => $validated['description_plante']  ?? null,
            'categorie_id'        => $validated['categorie_id'],
            'difficulte_plante'   => $validated['difficulte_plante'],
            'sunlight_plante'     => $validated['sunlight_plante'],
            'frequence_arrosage' => $validated['frequence_arrosage'] ?? null,
            'min_temp_plante'     => $validated['min_temp_plante']     ?? null,
            'max_temp_plante'     => $validated['max_temp_plante']     ?? null,
            'height_plante'       => $validated['height_plante']       ?? null,
            'days_to_recolte'      => $validated['days_to_recolte']      ?? null,
        ]);

        // Attach images
        foreach ($validated['images'] as $url) {
            $plante->images()->create(['path_image' => $url]);
        }

        // Attach planting steps (skip blank ones)
        if (!empty($validated['etapes'])) {
            foreach (array_filter($validated['etapes']) as $ordre => $description) {
                $plante->etapes()->create([
                    'instructions_etape' => $description,
                    'ordre_etape' => $ordre + 1,
                ]);
            }
        }

        return redirect()->route('admin.plantes.index')
                         ->with('success', 'Plant created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plante $plante)
    {
        $categories = Categorie::all();
        $plante->load(['images', 'categorie', 'etapes']);

        return view('plantes.edit', compact('plante', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plante $plante)
    {
        $validated = $request->validate([
            'nom_commun'          => 'required|string|max:255',
            'nom_scientifique'    => 'nullable|string|max:255',
            'description_plante'  => 'nullable|string',
            'categorie_id'        => 'required|exists:categories,id',
            'difficulte_plante'   => 'required|in:easy,medium,hard',
            'sunlight_plante'     => 'required|in:full sun,partial shade,full shade',
            'frequence_arrosage' => 'nullable|integer|min:0',
            'min_temp_plante'     => 'nullable|numeric',
            'max_temp_plante'     => 'nullable|numeric',
            'height_plante'       => 'nullable|numeric|min:0',
            'days_to_recolte'      => 'nullable|integer|min:1',
            'images'              => 'nullable|array',
            'images.*'            => 'url',
            'etapes'              => 'nullable|array',
            'etapes.*'            => 'nullable|string',
        ]);

        $plante->update([
            'nom_commun'          => $validated['nom_commun'],
            'nom_scientifique'    => $validated['nom_scientifique']    ?? null,
            'description_plante'  => $validated['description_plante']  ?? null,
            'categorie_id'        => $validated['categorie_id'],
            'difficulte_plante'   => $validated['difficulte_plante'],
            'sunlight_plante'     => $validated['sunlight_plante'],
            'frequence_arrosage' => $validated['frequence_arrosage'] ?? null,
            'min_temp_plante'     => $validated['min_temp_plante']     ?? null,
            'max_temp_plante'     => $validated['max_temp_plante']     ?? null,
            'height_plante'       => $validated['height_plante']       ?? null,
            'days_to_recolte'      => $validated['days_to_recolte']      ?? null,
        ]);

        // Replace images if new ones were submitted
        if (!empty($validated['images'])) {
            $plante->images()->delete();
            foreach ($validated['images'] as $url) {
                $plante->images()->create(['path_image' => $url]);
            }
        }

        // Replace steps if submitted
        if (isset($validated['etapes'])) {
            $plante->etapes()->delete();
            foreach (array_filter($validated['etapes']) as $ordre => $description) {
                $plante->etapes()->create([
                    'instructions_etape' => $description,
                    'ordre_etape' => $ordre + 1,
                ]);
            }
        }

        return redirect()->route('admin.plantes.index')
                         ->with('success', 'Plant updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plante $plante)
    {
        $plante->images()->delete();
        $plante->delete();

        return back()->with('success', 'Plant deleted successfully.');
    }
}
