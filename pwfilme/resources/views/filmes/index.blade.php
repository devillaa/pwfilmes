<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmes - ToVerde Films</title>
    <!-- CSS Principal -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/filmes.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <x-header />

        <div>
            <label for="ano">Ano</label>
            <input type="number" name="ano" id="ano" placeholder="Digite o ano" value="{{ request('ano') }}">
    <div class="container">
        <main>
            <h1 class="page-title">🎬 Catálogo de Filmes</h1>
            <p class="page-subtitle">Descubra milhares de filmes incríveis</p>

            <!-- Botão de adicionar filme (apenas para admins) -->
            @if (auth()->check() && auth()->user()->isAdmin)
                <div class="actions-header" data-animate>
                    <a href="{{ route('filmes.create') }}" class="btn btn-primary">
                        ➕ Adicionar Filme
                    </a>
                </div>
            @endif

            <!-- Filtros -->
            <div class="filtros-container" data-animate>
                <form method="GET" action="{{ route('filmes.index') }}" class="filtros-grid">
                    <div class="filtro-group">
                        <label for="ano" class="filtro-label">Ano</label>
                        <input type="number" name="ano" id="ano" placeholder="Digite o ano"
                            value="{{ request('ano') }}" class="filtro-input" min="1900" max="{{ date('Y') + 1 }}">
                    </div>

                    <div class="filtro-group">
                        <label for="categoria" class="filtro-label">Categoria</label>
                        <select name="categoria" id="categoria" class="filtro-input">
                            <option value="">Todas as categorias</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}"
                                    {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nome }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filtro-group">
                        <label class="filtro-label">&nbsp;</label>
                        <button type="submit" class="filtro-btn">
                            🔍 Filtrar
                        </button>
                    </div>
                </form>
            </div>

            <!-- Lista de Filmes -->
            <div class="filmes-container">
                @forelse ($filmes as $filme)
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
                                    <span class="avaliacao-count">({{ $filme->total_avaliacoes }} avaliações)</span>
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

                                @auth
                                    <form action="{{ route('favoritos.toggle', $filme->id) }}" method="POST"
                                        class="favorito-form">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-favorito btn-sm {{ $filme->isFavoritadoPor(auth()->id()) ? 'favoritado' : '' }}">
                                            {{ $filme->isFavoritadoPor(auth()->id()) ? '❤️' : '🤍' }}
                                            {{ $filme->isFavoritadoPor(auth()->id()) ? 'Favoritado' : 'Favoritar' }}
                                        </button>
                                    </form>
                                @endauth

                                @if (auth()->check() && auth()->user()->isAdmin)
                                    <a href="{{ route('filmes.edit', $filme->id) }}" class="btn btn-outline btn-sm">
                                        ✏️ Editar
                                    </a>

                                    <form action="{{ route('filmes.destroy', $filme->id) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline btn-sm">
                                            🗑️ Excluir
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Estado vazio -->
                    <div class="empty-state" data-animate>
                        <div class="empty-state-icon">🎬</div>
                        <h3 class="empty-state-title">Nenhum filme encontrado</h3>
                        <p class="empty-state-text">
                            @if (request('ano') || request('categoria'))
                                Tente ajustar os filtros para encontrar mais filmes.
                            @else
                                Ainda não há filmes cadastrados no sistema.
                            @endif
                        </p>

                        @if (auth()->check() && auth()->user()->isAdmin)
                            <a href="{{ route('filmes.create') }}" class="btn btn-primary">
                                ➕ Adicionar Primeiro Filme
                            </a>
                        @endif
                    </div>
                @endforelse
            </div>

            <!-- Paginação (se implementada) -->
            @if (method_exists($filmes, 'links'))
                <div class="pagination-container" data-animate>
                    {{ $filmes->links() }}
                </div>
            @endif
        </main>
    </div>

    <!-- JavaScript Principal -->
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- JavaScript da página de filmes -->
    <script src="{{ asset('js/filmes.js') }}"></script>
</body>

</html>
