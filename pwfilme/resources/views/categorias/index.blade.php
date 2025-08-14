<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias - ToVerde Films</title>

    <!-- CSS Principal -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/categorias.css') }}">

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
            <h1 class="page-title">📂 Gerenciar Categorias</h1>
            <p class="page-subtitle">Organize as categorias do seu catálogo de filmes</p>

            <div class="actions-header" data-animate>
                <a href="{{ route('categorias.create') }}" class="btn btn-primary">
                    ➕ Adicionar Categoria
                </a>
            </div>

            <div class="categorias-container">
                @forelse ($categorias as $categoria)
                    <div class="categoria-card" data-animate>
                        <div class="categoria-content">
                            <h3 class="categoria-title">{{ $categoria->nome }}</h3>
                            <p class="categoria-count">{{ $categoria->filmes->count() }} filmes</p>
                        </div>

                        <div class="categoria-actions">
                            <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-outline btn-sm">
                                ✏️ Editar
                            </a>

                            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST"
                                class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline btn-sm">
                                    🗑️ Excluir
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="empty-state" data-animate>
                        <div class="empty-state-icon">📂</div>
                        <h3 class="empty-state-title">Nenhuma categoria encontrada</h3>
                        <p class="empty-state-text">Crie sua primeira categoria para organizar os filmes!</p>
                        <a href="{{ route('categorias.create') }}" class="btn btn-primary">
                            ➕ Criar Primeira Categoria
                        </a>
                    </div>
                @endforelse
            </div>
        </main>
    </div>

    <!-- JavaScript Principal -->
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- JavaScript da página de categorias -->
    <script src="{{ asset('js/categorias.js') }}"></script>
</body>

</html>
