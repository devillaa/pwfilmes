<header>
    <a href="{{ route('filmes.index') }}">
        <h1>ToVerde Films</h1>
    </a>
    <nav>
        <a href="{{ route('filmes.index') }}">Filmes</a>

        @if (auth()->check())
            @if (auth()->user()->isAdmin)
                <a href="{{ route('filmes.create') }}">Cadastrar Filme</a>
                <a href="{{ route('categorias.index') }}">Categorias</a>
            @endif

            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Registrar</a>
        @endif
    </nav>
</header>
