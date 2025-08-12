<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    // Listar todas as categorias
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    // Mostrar formulário de criação (admin)
    public function create()
    {
        return view('categorias.create');
    }

    // Salvar nova categoria (admin)
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:categorias,nome',
        ]);

        Categoria::create([
            'nome' => $request->nome,
        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoria criada com sucesso!');
    }

    // Mostrar formulário de edição (admin)
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    // Atualizar categoria (admin)
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:categorias,nome,' . $categoria->id,
        ]);

        $categoria->update([
            'nome' => $request->nome,
        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    // Excluir categoria (admin)
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categorias.index')->with('success', 'Categoria excluída com sucesso!');
    }
}
