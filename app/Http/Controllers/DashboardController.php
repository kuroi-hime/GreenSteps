<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Plante;
use Illuminate\Support\Facades\DB;
// use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planted_plants = DB::table('plantes')
                                ->join('suivi', 'plantes.id', '=', 'plante_id')
                                ->count();
        $total_users = DB::table('users')
                            ->join('roles', 'users.role_id', '=', 'roles.id')
                            ->where('roles.nom_role', '!=', 'admin')
                            ->where('users.is_blocked', '=', 0)
                            ->distinct('users.id')
                            ->count('users.id');

        $total_plants = Plante::count();
        $categories = Categorie::withCount('suivis')
                                ->orderBy('suivis_count', 'desc')
                                ->limit(5)->get();
        $plantes = Plante::withCount('suivis')
                            ->orderBy('suivis_count', 'desc')
                            ->limit(5)->get();

        return view('dashboard', compact('categories', 'plantes', 'planted_plants', 'total_users', 'total_plants'));
    }
}
