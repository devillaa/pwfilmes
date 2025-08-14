<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - ToVerde Films</title>
    
    <!-- CSS Principal -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="auth-container">
        <div class="auth-background">
            <div class="overlay"></div>
        </div>

        <div class="auth-box" data-animate>
            <div class="auth-header">
                <h1>🍿 Criar Conta</h1>
                <p class="auth-subtitle">Junte-se à comunidade de cinéfilos</p>
            </div>

            {{-- Mensagem de sucesso --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Mensagens de erro --}}
            @if ($errors->any())
                <div class="alert alert-error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Nome Completo</label>
                    <input type="text" name="name" id="name" class="form-input" 
                        value="{{ old('name') }}" required 
                        placeholder="Seu nome completo">
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" id="email" class="form-input" 
                        value="{{ old('email') }}" required 
                        placeholder="seu@email.com">
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" name="password" id="password" class="form-input" 
                        required placeholder="Mínimo 6 caracteres">
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                        class="form-input" required placeholder="Confirme sua senha">
                </div>

                <button type="submit" class="btn btn-primary btn-lg auth-btn">
                    📝 Cadastrar
                </button>
            </form>

            <div class="auth-footer">
                <p>Já tem conta? 
                    <a href="{{ route('login') }}" class="auth-link">Entrar</a>
                </p>
            </div>
        </div>
    </div>

    <!-- JavaScript Principal -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
