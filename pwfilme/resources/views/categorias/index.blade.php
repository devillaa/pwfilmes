<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias - ToVerde Films</title>
    <link rel="stylesheet" href="{{ asset('css/categorias.css') }}">
</head>

<body>
    <x-header />

    <main>
        <h2>Lista de Categorias</h2>
        <div style="text-align: center; margin-bottom: 24px;">
            <a href="{{ route('categorias.create') }}" class="btn-add">+ Adicionar Categoria</a>
        </div>

        <div class="categorias-container">
            @foreach ($categorias as $categoria)
                <div class="categoria-card">
                    <h3>{{ $categoria->nome }}</h3>
                    <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn-ver"
                        style="background:#222a32;color:#00e054;margin-top:8px;">Editar</a>

                    <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" id="btn-destroy"
                            onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">
                            Excluir Categoria
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </main>
</body>

</html>
