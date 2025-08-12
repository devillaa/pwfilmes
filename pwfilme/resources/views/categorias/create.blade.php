<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cadastrar Categoria - ToVerde Films</title>
    <link rel="stylesheet" href="{{ asset('css/editar.css') }}">
</head>

<body>
    <x-header />

    <main>
        <h2>Cadastrar Categoria</h2>
        <div>
            <form action="{{ route('categorias.store') }}" method="POST">
                @csrf

                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required>

                <button type="submit" class="btn-trailer">Cadastrar Categoria</button>
            </form>

            <a href="{{ route('categorias.index') }}" class="btn-trailer" style="margin-top:12px; display:inline-block;">
                Voltar
            </a>
        </div>
    </main>
</body>

</html>
