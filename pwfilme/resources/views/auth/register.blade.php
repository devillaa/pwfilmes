<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - ToVerdeFilms</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>

<div class="overlay"></div>

<div class="register-box">
    <h1>🍿 Criar Conta</h1>
    <p class="subtitle">Junte-se à comunidade de cinéfilos e comece sua jornada no ToVerde.</p>

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

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label for="name">Nome</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <label for="email">E-mail</label>
        <input type="email" name="email" value="{{ old('email') }}" required>

        <label for="password">Senha</label>
        <input type="password" name="password" required>

        <label for="password_confirmation">Confirmar Senha</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit">Cadastrar</button>
    </form>

    <div class="link">
        Já tem conta? <a href="{{ route('login') }}">Entrar</a>
    </div>
</div>

</body>
</html>
