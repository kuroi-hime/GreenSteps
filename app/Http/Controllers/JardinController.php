<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
// use App\Http\Requests\StoreJardinRequest;
// use App\Http\Requests\UpdateJardinRequest;
use App\Models\Jardin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class JardinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jardin = Auth::user()->jardin;
        if(!$jardin)
            return redirect()->route('client.my-garden.create');
        // $count = \DB::table('suivi')->where('jardin_id', $jardin->id)->count();
        // dd("Nombre de lignes dans la table suivi pour ce jardin : ".$jardin->id."$$$$" . $count);
        $jardin->load('plantes');
        return view('garden.index', compact('jardin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('garden.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom_jardin' => ['required', 'string', 'max:255'],
            'description_jardin' => ['required', 'string', 'max:1000'],
        ]);


        Auth::user()->jardin()->create($validated);

        return redirect()->route('client.my-garden.index')->with('success', 'Jardin créé avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jardin $jardin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jardin $jardin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jardin $jardin)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jardin $jardin)
    {
        //
    }

    /**
     * 
     */
    public function addPlant(Request $request)
    {
        $validated = $request->validate([
            'plante_id' => ['required', 'exists:plantes,id'],
        ]);

        $jardin = Auth::user()->jardin()->first();
        
        if (!$jardin) {
            return redirect()->route('client.my-garden.create');
        }

        $jardin->plantes()->attach($validated['plante_id']);

        return redirect()->route('client.my-garden.index')
                        ->with('Success', 'La plante a été ajouter au jardin avec succés!');
    }

}
