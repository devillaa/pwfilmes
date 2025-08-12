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

    <form method="GET" action="{{ route('filmes.index') }}" class="filtros-container">
        <div>
            <label for="ano">Ano</label>
            <input type="number" name="ano" id="ano" placeholder="Digite o ano" value="{{ request('ano') }}">
        </div>

        <div>
            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria">
                <option value="">Todas</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria }}" {{ request('categoria') == $categoria ? 'selected' : '' }}>
                        {{ $categoria }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit">Filtrar</button>
        </div>
    </form>



    <main>
        <h2>Catálogo de Filmes</h2>
        <div class="filmes-container">
            @foreach ($filmes as $filme)
                <div class="filme-card">
                    @php
                        $img = filter_var($filme->imagem, FILTER_VALIDATE_URL)
                            ? $filme->imagem
                            : asset('storage/' . $filme->imagem);
                    @endphp
                    <img src="{{ $img }}" alt="{{ $filme->nome }}">
                    <h3>{{ $filme->nome }} ({{ $filme->ano }})</h3>
                    <p class="categoria">{{ $filme->categoria }}</p>
                    <p class="sinopse">{{ Str::limit($filme->sinopse, 100) }}</p>
                    <a href="{{ $filme->trailer }}" target="_blank" class="btn-trailer">Ver Trailer</a>
                    @if (auth()->check() && auth()->user()->isAdmin)
                        <a href="{{ route('filmes.edit', $filme->id) }}" class="btn-trailer"
                            style="background:#222a32;color:#00e054;margin-top:8px;">Editar</a>

                        <form action="{{ route('filmes.destroy', $filme->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" id="btn-destroy"
                            onclick="return confirm('Tem certeza que deseja excluir este filme?')">
                            Excluir Filme
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    </main>
</body>

</html>
