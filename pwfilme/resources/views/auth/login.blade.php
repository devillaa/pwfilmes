<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ToVerde Films</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<div class="login-box">
    <h1>🎬 ToVerde Films Login</h1>

    {{-- Mensagem de sucesso --}}
    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    {{-- Mensagens de erro --}}
    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label for="email">E-mail</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus>

        <label for="password">Senha</label>
        <input type="password" name="password" required>

        <button type="submit">Entrar</button>
    </form>

    <div class="link">
        Ainda não tem conta? <a href="{{ route('register') }}">Cadastre-se</a>
    </div>
</div>

</body>
</html>
