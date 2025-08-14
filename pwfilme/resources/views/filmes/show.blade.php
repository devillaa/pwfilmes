<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $filme->nome }} - ToVerde Films</title>
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
</head>

<body>
    <x-header />

    <main class="filme-detalhes">
        <div class="filme-header">
            <div class="filme-poster">
                @php
                    $img = filter_var($filme->imagem, FILTER_VALIDATE_URL)
                        ? $filme->imagem
                        : asset('storage/' . $filme->imagem);
                @endphp
                <img src="{{ $img }}" alt="{{ $filme->nome }}">
            </div>

            <div class="filme-info">
                <h1>{{ $filme->nome }}</h1>

                <div class="filme-meta">
                    <span class="ano">{{ $filme->ano }}</span>
                    <span class="categoria-badge">{{ $filme->categoria->nome }}</span>
                </div>

                <div class="sinopse-texto">
                    {{ $filme->sinopse }}
                </div>
            </div>
        </div>

        <div class="trailer-section">
            <h2>Trailer</h2>
            <div class="trailer-container">
                @php
                    // Extrair o ID do vídeo do YouTube da URL
                    $trailerUrl = $filme->trailer;
                    $videoId = '';

                    if (
                        preg_match(
                            '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/',
                            $trailerUrl,
                            $matches,
                        )
                    ) {
                        $videoId = $matches[1];
                    }
                @endphp

                @if ($videoId)
                    <iframe src="https://www.youtube.com/embed/{{ $videoId }}"
                        title="{{ $filme->nome }} - Trailer"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                @else
                    <div
                        style="display: flex; align-items: center; justify-content: center; height: 100%; background: #333; color: #fff; font-size: 1.2rem;">
                        Trailer não disponível
                    </div>
                @endif
            </div>
        </div>

        <div class="acoes-container">
            <a href="{{ route('filmes.index') }}" class="btn-voltar">Voltar ao Catálogo</a>

            @if (auth()->check() && auth()->user()->isAdmin)
                <a href="{{ route('filmes.edit', $filme->id) }}" class="btn-editar">Editar Filme</a>

                <form action="{{ route('filmes.destroy', $filme->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-excluir"
                        onclick="return confirm('Tem certeza que deseja excluir este filme?')">
                        Excluir Filme
                    </button>
                </form>
            @endif
        </div>
    </main>
</body>

</html>
