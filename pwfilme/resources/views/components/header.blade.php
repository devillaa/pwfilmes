<header class="header">
    <div class="header-content">
        <a href="{{ route('filmes.index') }}" class="logo">
            🎬 ToVerde Films
        </a>

        <nav class="nav-menu">
            <a href="{{ route('filmes.index') }}" class="nav-link {{ request()->routeIs('filmes.*') ? 'active' : '' }}">
                🎬 Filmes
            </a>

            @auth
                <a href="{{ route('favoritos.index') }}"
                    class="nav-link {{ request()->routeIs('favoritos.*') ? 'active' : '' }}">
                    ❤️ Favoritos
                </a>

                @if (auth()->user()->isAdmin)
                    <a href="{{ route('categorias.index') }}"
                        class="nav-link {{ request()->routeIs('categorias.*') ? 'active' : '' }}">
                        📂 Categorias
                    </a>

                    <a href="{{ route('tmdb.dashboard') }}"
                        class="nav-link {{ request()->routeIs('tmdb.*') ? 'active' : '' }}">
                        📊 Dashboard
                    </a>
                @endif
            @endauth
        </nav>

        <div class="header-actions">
            @auth
                <div class="user-menu">
                    <span class="user-name">{{ auth()->user()->name }}</span>

                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="btn btn-outline btn-sm">
                            🚪 Sair
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}">
                    🔑 Login
                </a>

                <a href="{{ route('register') }}" class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}">
                    📝 Cadastro
                </a>
            @endauth
        </div>
    </div>

    <style>
        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-name {
            font-weight: 500;
            color: var(--text-primary);
        }

        .logout-form {
            margin: 0;
        }

        .theme-toggle {
            background: none;
            border: none;
            color: var(--text-primary);
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .theme-toggle:hover {
            background: var(--bg-tertiary);
        }
    </style>
</header>
