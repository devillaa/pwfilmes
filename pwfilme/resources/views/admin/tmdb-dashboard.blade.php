<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ToVerde Films</title>

    <!-- CSS Principal -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

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
            <h1 class="dashboard-title">
                📊 Dashboard Administrativo
            </h1>
            <p class="dashboard-subtitle">
                Gerencie seu sistema de filmes
            </p>

            <!-- Estatísticas -->
            <div class="stats-container">
                <div class="stat-card" data-animate>
                    <h3>📊 Estatísticas Gerais</h3>
                    <div class="stat-item">
                        <span class="stat-label">Total de Filmes:</span>
                        <span class="stat-value">{{ $totalFilmes }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Total de Categorias:</span>
                        <span class="stat-value">{{ \App\Models\Categoria::count() }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Total de Usuários:</span>
                        <span class="stat-value">{{ \App\Models\User::count() }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Total de Favoritos:</span>
                        <span class="stat-value">{{ \App\Models\FilmeFavorito::count() }}</span>
                    </div>
                </div>

                <!-- Card de informações adicionais -->
                <div class="stat-card" data-animate>
                    <h3>⚡ Informações Rápidas</h3>
                    <div class="stat-item">
                        <span class="stat-label">Filmes por Categoria:</span>
                        <span
                            class="stat-value">{{ \App\Models\Categoria::withCount('filmes')->get()->sum('filmes_count') }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Categoria Mais Popular:</span>
                        <span class="stat-value">
                            @php
                                $categoriaMaisPopular = \App\Models\Categoria::withCount('filmes')
                                    ->having('filmes_count', '>', 0)
                                    ->orderBy('filmes_count', 'desc')
                                    ->first();
                            @endphp
                            {{ $categoriaMaisPopular ? $categoriaMaisPopular->nome : 'N/A' }}
                        </span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Filme Mais Favoritado:</span>
                        <span class="stat-value">
                            @php
                                $filmeMaisFavoritado = \App\Models\Filme::withCount('favoritos')
                                    ->having('favoritos_count', '>', 0)
                                    ->orderBy('favoritos_count', 'desc')
                                    ->first();
                            @endphp
                            {{ $filmeMaisFavoritado ? Str::limit($filmeMaisFavoritado->nome, 20) : 'N/A' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Ações Rápidas -->
            <div class="actions-container" data-animate>
                <h3>🚀 Ações Rápidas</h3>

                <div class="actions-grid">
                    <a href="{{ route('filmes.create') }}" class="action-card">
                        <div class="action-icon">➕</div>
                        <h4>Adicionar Filme</h4>
                        <p>Cadastre um novo filme no sistema</p>
                    </a>

                    <a href="{{ route('categorias.create') }}" class="action-card">
                        <div class="action-icon">📂</div>
                        <h4>Nova Categoria</h4>
                        <p>Crie uma nova categoria de filmes</p>
                    </a>

                    <a href="{{ route('filmes.index') }}" class="action-card">
                        <div class="action-icon">🎬</div>
                        <h4>Gerenciar Filmes</h4>
                        <p>Visualize e edite todos os filmes</p>
                    </a>

                    <a href="{{ route('categorias.index') }}" class="action-card">
                        <div class="action-icon">🗂️</div>
                        <h4>Gerenciar Categorias</h4>
                        <p>Organize as categorias do sistema</p>
                    </a>
                </div>
            </div>

            <!-- Últimas Atividades -->
            <div class="activities-container" data-animate>
                <h3>📝 Últimas Atividades</h3>

                <div class="activities-list">
                    @php
                        $ultimosFilmes = \App\Models\Filme::whereNotNull('created_at')->latest()->take(5)->get();
                    @endphp

                    @forelse ($ultimosFilmes as $filme)
                        <div class="activity-item">
                            <div class="activity-icon">🎬</div>
                            <div class="activity-content">
                                <h4>{{ $filme->nome }}</h4>
                                <p>Adicionado em
                                    {{ $filme->created_at ? $filme->created_at->format('d/m/Y H:i') : 'Data não disponível' }}
                                </p>
                            </div>
                            <a href="{{ route('filmes.show', $filme->id) }}" class="btn btn-outline btn-sm">
                                Ver
                            </a>
                        </div>
                    @empty
                        <div class="activity-item">
                            <div class="activity-icon">📝</div>
                            <div class="activity-content">
                                <h4>Nenhuma atividade recente</h4>
                                <p>Não há filmes cadastrados ainda</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>

    <!-- JavaScript Principal -->
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- JavaScript do Dashboard -->
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>

</html>
