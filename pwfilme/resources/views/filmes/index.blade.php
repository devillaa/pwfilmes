<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmes - ToVerde Films</title>
    <link rel="stylesheet" href="{{ asset('css/filmes.css') }}">
</head>
<body>
    <x-header />


    <main>
        <h2>Catálogo de Filmes</h2>
        <div class="filmes-container">
            @foreach($filmes as $filme)
                <div class="filme-card">
                    <img src="{{ asset('storage/' . $filme->imagem) }}" alt="{{ $filme->nome }}">
                    <h3>{{ $filme->nome }} ({{ $filme->ano }})</h3>
                    <p class="categoria">{{ $filme->categoria }}</p>
                    <p class="sinopse">{{ Str::limit($filme->sinopse, 100) }}</p>
                    <a href="{{ $filme->trailer }}" target="_blank" class="btn-trailer">Ver Trailer</a>
                </div>
            @endforeach
        </div>
    </main>
</body>
</html>
