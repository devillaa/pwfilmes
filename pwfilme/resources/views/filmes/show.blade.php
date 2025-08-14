<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $filme->nome }} - ToVerde Films</title>

    <!-- CSS Principal -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <x-header />

    <div class="container">
        <main class="filme-detalhes" data-animate>
            <div class="filme-header">
                <div class="filme-poster">
                    @php
                        $img = filter_var($filme->imagem, FILTER_VALIDATE_URL)
                            ? $filme->imagem
                            : asset('storage/' . $filme->imagem);
                    @endphp
                    <img src="{{ $img }}" alt="{{ $filme->nome }}"
                        onerror="this.src='{{ asset('images/placeholder-movie.jpg') }}'">
                </div>

                <div class="filme-info">
                    <h1 class="filme-title">{{ $filme->nome }}</h1>

                    <div class="filme-meta">
                        <span class="ano">{{ $filme->ano }}</span>
                        <span class="categoria-badge">{{ $filme->categoria->nome }}</span>
                        @if ($filme->avaliacao_media > 0)
                            <span class="avaliacao-badge">⭐ {{ number_format($filme->avaliacao_media, 1) }}/5</span>
                        @endif
                    </div>

                    @if ($filme->diretor)
                        <p class="diretor"><strong>Diretor:</strong> {{ $filme->diretor }}</p>
                    @endif

                    @if ($filme->duracao)
                        <p class="duracao"><strong>Duração:</strong> {{ $filme->duracao }} minutos</p>
                    @endif

                    @if ($filme->elenco)
                        <p class="elenco"><strong>Elenco:</strong> {{ $filme->elenco }}</p>
                    @endif

                    <div class="sinopse-texto">
                        <h3>Sinopse</h3>
                        <p>{{ $filme->sinopse }}</p>
                    </div>

                    @auth
                        <div class="favorito-container">
                            <form action="{{ route('favoritos.toggle', $filme->id) }}" method="POST"
                                class="favorito-form">
                                @csrf
                                <button type="submit"
                                    class="btn btn-favorito {{ $filme->isFavoritadoPor(auth()->id()) ? 'favoritado' : '' }}">
                                    {{ $filme->isFavoritadoPor(auth()->id()) ? '❤️' : '🤍' }}
                                    {{ $filme->isFavoritadoPor(auth()->id()) ? 'Favoritado' : 'Adicionar aos Favoritos' }}
                                </button>
                            </form>
                        </div>
                    @endauth
                </div>
            </div>

            @if ($filme->trailer)
                <div class="trailer-section" data-animate>
                    <h2>🎬 Trailer</h2>
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
                            <div class="trailer-placeholder">
                                <p>Trailer não disponível</p>
                                <a href="{{ $filme->trailer }}" target="_blank" class="btn btn-outline">
                                    Ver no YouTube
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            <div class="acoes-container" data-animate>
                <a href="{{ route('filmes.index') }}" class="btn btn-outline">← Voltar ao Catálogo</a>

                @if (auth()->check() && auth()->user()->isAdmin)
                    <a href="{{ route('filmes.edit', $filme->id) }}" class="btn btn-primary">✏️ Editar Filme</a>

                    <form action="{{ route('filmes.destroy', $filme->id) }}" method="POST" class="delete-form"
                        style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline">
                            🗑️ Excluir Filme
                        </button>
                    </form>
                @endif
            </div>
        </main>
    </div>

    <!-- JavaScript Principal -->
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- JavaScript da página de detalhes -->
    <script src="{{ asset('js/show.js') }}"></script>
</body>

</html>
