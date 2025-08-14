<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo - ToVerde Films</title>

    <!-- CSS Principal -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="hero-section">
        <div class="overlay"></div>

        <div class="container">
            <div class="hero-content" data-animate>
                <h1 class="hero-title">🎬 ToVerde Films</h1>
                <p class="hero-subtitle">
                    Sua experiência definitiva para acompanhar filmes, escrever críticas e descobrir novidades do
                    cinema.
                </p>

                <div class="hero-buttons">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                        🎟️ Entrar
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline btn-lg">
                        🍿 Cadastrar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="features-section" data-animate>
            <h2 class="section-title">✨ Por que escolher o ToVerde Films?</h2>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🎬</div>
                    <h3>Catálogo Completo</h3>
                    <p>Milhares de filmes organizados por categoria, ano e avaliação</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">❤️</div>
                    <h3>Sistema de Favoritos</h3>
                    <p>Salve seus filmes preferidos e acesse rapidamente</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">📱</div>
                    <h3>Design Responsivo</h3>
                    <p>Interface moderna que funciona em qualquer dispositivo</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3>Navegação Rápida</h3>
                    <p>Filtros inteligentes para encontrar exatamente o que procura</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p>📅 {{ date('Y') }} • ToVerde Films - Feito para cinéfilos</p>
        </div>
    </footer>

    <!-- JavaScript Principal -->
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- JavaScript da página home -->
    <script src="{{ asset('js/home.js') }}"></script>
</body>

</html>
