<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Categoria - ToVerde Films</title>

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
            <h1 class="page-title">📂 Criar Nova Categoria</h1>
            <p class="page-subtitle">Adicione uma nova categoria ao seu catálogo</p>

            <div class="form-container" data-animate>
                <form action="{{ route('categorias.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="nome" class="form-label">Nome da Categoria</label>
                        <input type="text" name="nome" id="nome" class="form-input"
                            value="{{ old('nome') }}" required placeholder="Ex: Ação, Drama, Comédia...">

                        @error('nome')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            ➕ Criar Categoria
                        </button>

                        <a href="{{ route('categorias.index') }}" class="btn btn-outline">
                            ← Voltar
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- JavaScript Principal -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
