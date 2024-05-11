@include('layouts.header')

<body>
    <nav class="navbar navbar-dark bg-dark navbar-expand-sm">
        <div class="container-fluid">
            @auth
                <div class="navbar-nav me-auto">
                    <a class="nav-link" aria-current="page" href="{{ auth()->user()->cargo === "admin" ? route('admin.index') : route('user.index') }}">Inicio</a>
                    <a class="nav-link" aria-current="page" href="{{ route('profile') }}">Perfil</a>
                </div>
                <div class="navbar-nav ms-auto">
                    <form class="m-0" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link btn btn-danger text-white">Cerrar sesión</button>
                    </form>
                </div>
            @endauth

            @guest
                <div class="navbar-nav mx-auto">
                    <p class="nav-link text-white m-0">Inicio de sesión</p>
                </div>
            @endguest
        </div>
    </nav>
    @yield('main-container')
    @include('layouts.footer')
    @stack('js')
</body>

</html>
