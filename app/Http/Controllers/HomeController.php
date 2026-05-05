<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\User;
// use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::with('plantes')->get();
        // Erreur illogique
        $gardeners = User::whereHas('role', function ($query) {
                        $query->where('nom_role', '=', 'jardinier');
                    })->count();

        return view('home', compact('categories', 'gardeners'));
    }
}
