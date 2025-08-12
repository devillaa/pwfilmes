<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use Illuminate\Http\Request;

class FilmesController extends Controller
{
    // Listar todos os filmes
    public function index()
    {
        $filmes = Filme::all();
        return view('filmes.index', compact('filmes'));
    }

    // Visualizar detalhes de um filme (usuário)
    public function show(Filme $filme)
    {
        return view('filmes.show', compact('filme'));
    }

    // Mostrar formulário de criação (admin)
    public function create()
    {
        return view('filmes.create');
    }

    // Salvar novo filme (admin)
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'sinopse' => 'required|string',
            'ano' => 'required|integer',
            'categoria' => 'required|string|max:255',
            'imagem' => 'required|string|max:255',
            'trailer' => 'required|string|max:255',
        ]);

        Filme::create($request->all());

        return redirect()->route('filmes.index')->with('success', 'Filme cadastrado com sucesso!');
    }

    // Mostrar formulário de edição (admin)
    public function edit(Filme $filme)
    {
        return view('filmes.edit', compact('filme'));
    }

    // Atualizar filme (admin)
    public function update(Request $request, Filme $filme)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'sinopse' => 'required|string',
            'ano' => 'required|integer',
            'categoria' => 'required|string|max:255',
            'imagem' => 'required|string|max:255',
            'trailer' => 'required|string|max:255',
        ]);

        $filme->update($request->all());

        return redirect()->route('filmes.index')->with('success', 'Filme atualizado com sucesso!');
    }

    // Excluir filme (admin)
    public function destroy(Filme $filme)
    {
        $filme->delete();
        return redirect()->route('filmes.index')->with('success', 'Filme excluído com sucesso!');
    }
}
