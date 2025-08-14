<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use App\Models\Categoria;
use App\Models\User;
use App\Models\FilmeFavorito;
use Illuminate\Http\Request;

class TMDBController extends Controller
{
    public function dashboard()
    {
        $totalFilmes = Filme::count();
        $totalCategorias = Categoria::count();
        $totalUsuarios = User::count();
        $totalFavoritos = FilmeFavorito::count();

        return view('admin.tmdb-dashboard', compact(
            'totalFilmes',
            'totalCategorias',
            'totalUsuarios',
            'totalFavoritos'
        ));
    }
}
