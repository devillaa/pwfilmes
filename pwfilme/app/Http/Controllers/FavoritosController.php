<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use App\Models\FilmeFavorito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritosController extends Controller
{
    public function index()
    {
        $filmesFavoritos = Auth::user()->filmesFavoritos()->with('categoria')->get();
        return view('favoritos.index', compact('filmesFavoritos'));
    }

    public function toggle(Request $request, Filme $filme)
    {
        $user = Auth::user();

        $favorito = FilmeFavorito::where('user_id', $user->id)
            ->where('filme_id', $filme->id)
            ->first();

        if ($favorito) {
            // Remove dos favoritos
            $favorito->delete();
            $message = 'Filme removido dos favoritos!';
            $isFavorito = false;
        } else {
            // Adiciona aos favoritos
            FilmeFavorito::create([
                'user_id' => $user->id,
                'filme_id' => $filme->id,
            ]);
            $message = 'Filme adicionado aos favoritos!';
            $isFavorito = true;
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'isFavorito' => $isFavorito
            ]);
        }

        return back()->with('success', $message);
    }

    public function destroy(Filme $filme)
    {
        $user = Auth::user();

        FilmeFavorito::where('user_id', $user->id)
            ->where('filme_id', $filme->id)
            ->delete();

        return redirect()->route('favoritos.index')->with('success', 'Filme removido dos favoritos!');
    }
}
