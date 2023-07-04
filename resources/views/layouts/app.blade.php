<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    {{-- Icon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css"
        integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/home">
                    <i class="fa-solid fa-circle-nodes"></i>
                    Feedzz
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Masuk') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Daftar') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a href="/post/create" class="nav-link"><i class="fa-solid fa-upload"></i></a>
                            </li>

                            <li class="nav-item">
                                <a href="/{{ '@' . Auth::user()->username }}"
                                    class="nav-link">{{ Auth::user()->username }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="/notification" class="nav-link"><i class="fa-solid fa-bell"></i> <small
                                        id="notif_count"></small> </a>


                                <script>
                                    fetch('/notification/count')
                                        .then(response => response.json())
                                        .then(data => {

                                            if (parseInt(data.total) != 0)
                                                document.getElementById('notif_count').innerText = parseInt(data.total)
                                        }).catch(err => {
                                            console.log(err);
                                        })
                                </script>
                            </li>

                            <li class="nav-item ">

                                <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                                          document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </li>
                            <li class="nav-item ">

                                <form action="/search" method="GET">
                                    <div class="input-group rounded">

                                        <input type="search" class="form-control rounded" placeholder="cari.."
                                            aria-label="Search" aria-describedby="search-addon" name="query" />
                                        <button class="input-group-text border-0" id="search-addon" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>

                                </form>
                            </li>
                        @endguest


                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
