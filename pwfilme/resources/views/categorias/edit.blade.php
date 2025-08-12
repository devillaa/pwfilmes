<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoria - ToVerde Films</title>
    <link rel="stylesheet" href="{{ asset('css/editar.css') }}">
</head>

<body>
    <x-header />

    <main>
        <h2>Editar Categoria</h2>
        <div>
            <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
                @csrf
                @method('PUT')

                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" value="{{ old('nome', $categoria->nome) }}" required>

                <button type="submit" class="btn-trailer">Salvar Alterações</button>
            </form>

            <a href="{{ route('categorias.index') }}" class="btn-trailer">
                Voltar
            </a>
        </div>
    </main>
</body>

</html>
