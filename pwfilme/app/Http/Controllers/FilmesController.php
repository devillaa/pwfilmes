<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Filme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilmesController extends Controller
{
    public function home()
    {
        return view('home');
    }

    // Listar todos os filmes
    public function index(Request $request)
    {
        $query = Filme::query();

        if ($request->filled('ano')) {
            $query->where('ano', $request->ano);
        }

        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->categoria);
        }

        $filmes = $query->with('categoria')->get();

        $categorias = Categoria::all();

        return view('filmes.index', compact('filmes', 'categorias'));
    }

    // Visualizar detalhes de um filme (usuário)
    public function show(Filme $filme)
    {
        return view('filmes.show', compact('filme'));
    }

    // Mostrar formulário de criação (admin)
    public function create()
    {
        $categorias = Categoria::all();

        return view('filmes.create', compact('categorias'));
    }

    // Salvar novo filme (admin)
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'sinopse' => 'required|string',
            'ano' => 'required|integer',
            'categoria' => 'required|exists:categorias,id',
            'trailer' => 'nullable|string|max:255',
            'imagem_arquivo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'imagem_url' => 'nullable|url|max:255',
        ]);

        // Lógica para imagem
        $imagem = null;
        if ($request->hasFile('imagem_arquivo')) {
            $imagem = $request->file('imagem_arquivo')->store('filmes', 'public');
        } elseif ($request->filled('imagem_url')) {
            $imagem = $request->imagem_url;
        }

        Filme::create([
            'nome' => $request->nome,
            'sinopse' => $request->sinopse,
            'ano' => $request->ano,
            'categoria_id' => $request->categoria,
            'imagem' => $imagem,
            'trailer' => $request->trailer,
        ]);

        return redirect()->route('filmes.index')->with('success', 'Filme cadastrado com sucesso!');
    }

    // Mostrar formulário de edição (admin)
    public function edit(Filme $filme)
    {
        $categorias = Categoria::all();
        return view('filmes.edit', compact('filme', 'categorias'));
    }

    // Atualizar filme (admin)
    public function update(Request $request, Filme $filme)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'sinopse' => 'required|string',
            'ano' => 'required|integer',
            'categoria' => 'required|exists:categorias,id',
            'trailer' => 'nullable|string|max:255',
            'imagem_arquivo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'imagem_url' => 'nullable|url|max:255',
        ]);

        // Lógica para imagem
        $imagem = $filme->imagem;
        if ($request->hasFile('imagem_arquivo')) {
            // Remove imagem antiga se for arquivo local
            if ($imagem && !filter_var($imagem, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($imagem);
            }
            $imagem = $request->file('imagem_arquivo')->store('filmes', 'public');
        } elseif ($request->filled('imagem_url')) {
            // Remove imagem antiga se for arquivo local
            if ($imagem && !filter_var($imagem, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete($imagem);
            }
            $imagem = $request->imagem_url;
        }

        $filme->update([
            'nome' => $request->nome,
            'sinopse' => $request->sinopse,
            'ano' => $request->ano,
            'categoria_id' => $request->categoria,
            'imagem' => $imagem,
            'trailer' => $request->trailer,
        ]);

        return redirect()->route('filmes.index')->with('success', 'Filme atualizado com sucesso!');
    }

    // Excluir filme (admin)
    public function destroy(Filme $filme)
    {
        // Remove imagem do storage se for arquivo local
        if ($filme->imagem && !filter_var($filme->imagem, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($filme->imagem);
        }
        $filme->delete();
        return redirect()->route('filmes.index')->with('success', 'Filme excluído com sucesso!');
    }
}
