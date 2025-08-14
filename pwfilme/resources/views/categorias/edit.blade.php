<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoria - ToVerde Films</title>

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
            <h1 class="page-title">✏️ Editar Categoria</h1>
            <p class="page-subtitle">Atualize as informações da categoria</p>

            <div class="form-container" data-animate>
                <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nome" class="form-label">Nome da Categoria</label>
                        <input type="text" name="nome" id="nome" class="form-input"
                            value="{{ old('nome', $categoria->nome) }}" required
                            placeholder="Ex: Ação, Drama, Comédia...">

                        @error('nome')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            💾 Salvar Alterações
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
