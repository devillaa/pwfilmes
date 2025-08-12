<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cadastrar Filme - ToVerde Films</title>
    <link rel="stylesheet" href="{{ asset('css/editar.css') }}">
</head>

<body>
    <x-header />

    <main>
        <h2>Cadastrar Filme</h2>
        <div>
            <form action="{{ route('filmes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" value="{{ old('nome') }}" required>

                <label for="sinopse" style="color:#00e054;">Sinopse</label>
                <textarea name="sinopse" id="sinopse" rows="4" required>{{ old('sinopse') }}</textarea>

                <label for="ano">Ano</label>
                <input type="number" name="ano" id="ano" value="{{ old('ano') }}" required>

                <label for="categoria" style="color:#00e054;">Categoria</label>
                <input type="text" name="categoria" id="categoria" value="{{ old('categoria') }}" required>

                <label for="imagem">Imagem da Capa</label>
                <div>
                    <input type="file" name="imagem_arquivo" id="imagem_arquivo" accept="image/*">
                    <div>ou</div>
                    <input type="text" name="imagem_url" id="imagem_url" placeholder="URL da imagem"
                        value="{{ old('imagem_url') }}">
                </div>

                <label for="trailer">Link do Trailer (YouTube)</label>
                <input type="text" name="trailer" id="trailer" value="{{ old('trailer') }}" required>

                <button type="submit" class="btn-trailer">Cadastrar Filme</button>
            </form>

            <a href="{{ route('filmes.index') }}" class="btn-trailer">
                Voltar
            </a>
        </div>
    </main>
</body>

</html>
