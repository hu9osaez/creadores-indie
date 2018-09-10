<nav class="navbar" role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="{{ route('front::home') }}">
                <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div class="navbar-menu">
            <div class="navbar-end">
                @auth
                <a href="{{ route('logout') }}" class="navbar-item">Salir</a>
                @endauth

                @guest
                <a href="{{ route('login') }}" class="navbar-item">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="navbar-item">Crear cuenta</a>
                @endguest
            </div>
        </div>
    </div>
</nav>
