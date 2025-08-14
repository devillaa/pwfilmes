<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Favoritos - ToVerde Films</title>

    <!-- CSS Principal -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/filmes.css') }}">
    <link rel="stylesheet" href="{{ asset('css/favoritos.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <x-header />

    <div class="container">
        <main>
            <h1 class="page-title">❤️ Meus Favoritos</h1>
            <p class="page-subtitle">Seus filmes favoritos em um só lugar</p>

            @if ($filmesFavoritos->count() > 0)
                <div class="filmes-container">
                    @foreach ($filmesFavoritos as $filme)
                        <div class="filme-card" data-animate>
                            <!-- Imagem do filme -->
                            <img src="{{ filter_var($filme->imagem, FILTER_VALIDATE_URL) ? $filme->imagem : asset('storage/' . $filme->imagem) }}"
                                alt="{{ $filme->nome }}" loading="lazy"
                                onerror="this.src='{{ asset('images/placeholder-movie.jpg') }}'">

                            <!-- Conteúdo do card -->
                            <div class="filme-content">
                                <h3 class="filme-title">{{ $filme->nome }}</h3>
                                <p class="filme-year">({{ $filme->ano }})</p>

                                <span class="filme-categoria">{{ $filme->categoria->nome }}</span>

                                @if ($filme->avaliacao_media > 0)
                                    <div class="filme-avaliacao">
                                        ⭐ {{ number_format($filme->avaliacao_media, 1) }}/5
                                        <span class="avaliacao-count">({{ $filme->total_avaliacoes }}
                                            avaliações)</span>
                                    </div>
                                @endif

                                <p class="filme-sinopse">{{ Str::limit($filme->sinopse, 120) }}</p>

                                <!-- Ações do filme -->
                                <div class="filme-actions">
                                    <a href="{{ route('filmes.show', $filme->id) }}" class="btn btn-primary btn-sm">
                                        👁️ Ver Detalhes
                                    </a>

                                    @if ($filme->trailer)
                                        <a href="{{ $filme->trailer }}" target="_blank" rel="noopener"
                                            class="btn btn-outline btn-sm">
                                            🎬 Ver Trailer
                                        </a>
                                    @endif

                                    <form action="{{ route('favoritos.destroy', $filme->id) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline btn-sm">
                                            ❤️ Remover dos Favoritos
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state" data-animate>
                    <div class="empty-state-icon">❤️</div>
                    <h3 class="empty-state-title">Nenhum filme favoritado ainda</h3>
                    <p class="empty-state-text">Explore o catálogo e adicione seus filmes favoritos!</p>
                    <a href="{{ route('filmes.index') }}" class="btn btn-primary">
                        🎬 Explorar Filmes
                    </a>
                </div>
            @endif
        </main>
    </div>

    <!-- JavaScript Principal -->
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- JavaScript da página de favoritos -->
    <script src="{{ asset('js/favoritos.js') }}"></script>
</body>

</html>
