<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Fontawesome JS -->
    <script src="https://kit.fontawesome.com/1aa10d38c2.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <div class="container-fluid">
            {{-- !Navbar --}}
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                {{ config('app.name', 'SIAKAD') }}
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <!-- Left Side Of Navbar -->
                                @if (Auth::check())
                                    <ul class="nav nav-underline">

                                    </ul>
                                @endif

                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ms-auto">
                                    <!-- Authentication Links -->
                                    @guest
                                        @if (Route::has('login'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </li>
                                        @endif

                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                                role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false" v-pre>
                                                {{ Auth::user()->name }}
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    @endguest
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            {{-- !Navbar --}}

            {{-- !Body --}}
            <main class="row">
                {{-- *Sidebar --}}
                @auth()
                    <div class="col-md-2 border-end">
                        <div class="list-group mt-3">
                            <a href="{{ route('home') }}"
                                class="list-group-item list-group-item-action {{ request()->routeIs('home') ? 'active' : '' }}">
                                <i class="fas fa-home"></i> <span class="d-none d-sm-inline">Home</span>
                            </a>
                            <a href="{{ route('mahasiswa.index') }}"
                                class="list-group-item list-group-item-action {{ request()->routeIs('mahasiswa.index') ? 'active' : '' }}">
                                <i class="fas fa-users"></i> <span class="d-none d-sm-inline">Data Mahasiswa</span>
                            </a>
                            <a href="{{ route('jadwal-kuliah.index') }}"
                                class="list-group-item list-group-item-action {{ request()->routeIs('jadwal-kuliah.index') ? 'active' : '' }}">
                                <i class="fas fa-calendar-alt"></i> <span class="d-none d-sm-inline">Jadwal
                                    Perkuliahan</span>
                            </a>
                            <a href="{{ route('prodi.index') }}"
                                class="list-group-item list-group-item-action {{ request()->routeIs('prodi.index') ? 'active' : '' }}">
                                <i class="fas fa-university"></i> <span class="d-none d-sm-inline">Data Prodi</span>
                            </a>
                        </div>
                    </div>
                @endauth
                {{-- *Sidebar --}}

                {{-- *Content --}}
                <div class="col-md-{{ Auth::check() ? '10' : '12'; }}">
                    @yield('content')
                </div>
                {{-- *Content --}}
            </main>
            {{-- !Body --}}

            {{-- !Footer --}}
            <div class="row">
                <div class="col-md-12">
                    <footer class="footer mt-auto py-2 bg-light fixed-bottom text-center border-top">
                        <div class="container">
                            <span class="text-muted">
                                &copy; {{ date('Y') }} {{ config('app.name', 'SIAKAD') }}. All rights reserved.
                            </span>
                        </div>
                    </footer>
                </div>
            </div>
            {{-- !Footer --}}
        </div>
    </div>
</body>
</html>
