<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo - ToVerde Films</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>

<div class="overlay"></div>

<div class="container">
    <h1>🎬 ToVerde Films</h1>
    <p class="subtitle">Sua experiência definitiva para acompanhar filmes, escrever críticas e descobrir novidades do cinema.</p>

    <div class="buttons">
        <a href="{{ route('login') }}" class="btn login-btn">🎟 Entrar</a>
        <a href="{{ route('register') }}" class="btn register-btn">🍿 Cadastrar</a>
    </div>

    <footer>
        <p>📅 {{ date('Y') }} • ToVerdeApp - Feito para cinéfilos</p>
    </footer>
</div>

</body>
</html>
