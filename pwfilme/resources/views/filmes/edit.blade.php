<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Filme - ToVerde Films</title>

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

    <div class="container">
        <main>
            <h1 class="page-title">✏️ Editar Filme</h1>
            <p class="page-subtitle">Atualize as informações do filme</p>

            <div class="form-container" data-animate>
                <form action="{{ route('filmes.update', $filme->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nome" class="form-label">Nome do Filme</label>
                        <input type="text" name="nome" id="nome" class="form-input"
                            value="{{ old('nome', $filme->nome) }}" required placeholder="Ex: O Poderoso Chefão">

                        @error('nome')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sinopse" class="form-label">Sinopse</label>
                        <textarea name="sinopse" id="sinopse" class="form-textarea" rows="4" required
                            placeholder="Descreva a história do filme...">{{ old('sinopse', $filme->sinopse) }}</textarea>

                        @error('sinopse')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="ano" class="form-label">Ano de Lançamento</label>
                            <input type="number" name="ano" id="ano" class="form-input"
                                value="{{ old('ano', $filme->ano) }}" required min="1900" max="{{ date('Y') + 1 }}"
                                placeholder="Ex: 2023">

                            @error('ano')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="categoria" class="form-label">Categoria</label>
                            <select name="categoria" id="categoria" class="form-select" required>
                                <option value="">Selecione uma categoria</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}"
                                        {{ old('categoria', $filme->categoria_id) == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nome }}
                                    </option>
                                @endforeach
                            </select>

                            @error('categoria')
                                <div class="field-error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="trailer" class="form-label">Link do Trailer (YouTube)</label>
                        <input type="url" name="trailer" id="trailer" class="form-input"
                            value="{{ old('trailer', $filme->trailer) }}"
                            placeholder="https://www.youtube.com/watch?v=...">

                        @error('trailer')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Imagem da Capa</label>

                        @if ($filme->imagem)
                            <div class="current-image">
                                <span class="current-image-label">Imagem atual:</span>
                                <img src="{{ filter_var($filme->imagem, FILTER_VALIDATE_URL) ? $filme->imagem : asset('storage/' . $filme->imagem) }}"
                                    alt="Capa atual" class="current-image-preview">
                            </div>
                        @endif

                        <div class="image-options">
                            <div class="image-option">
                                <label for="imagem_arquivo" class="image-option-label">📁 Enviar novo arquivo</label>
                                <input type="file" name="imagem_arquivo" id="imagem_arquivo" accept="image/*"
                                    class="form-file">
                            </div>

                            <div class="image-divider">ou</div>

                            <div class="image-option">
                                <label for="imagem_url" class="image-option-label">🔗 Nova URL da imagem</label>
                                <input type="url" name="imagem_url" id="imagem_url" class="form-input"
                                    value="{{ old('imagem_url', filter_var($filme->imagem, FILTER_VALIDATE_URL) ? $filme->imagem : '') }}"
                                    placeholder="https://exemplo.com/imagem.jpg">
                            </div>
                        </div>

                        @error('imagem_arquivo')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                        @error('imagem_url')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            💾 Salvar Alterações
                        </button>

                        <a href="{{ route('filmes.index') }}" class="btn btn-outline">
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
