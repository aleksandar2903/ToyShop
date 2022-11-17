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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-lg">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <img width="30"
                    src="{{asset('/storage/images/toy-train.png')}}" alt="">
                <div class="collapse navbar-collapse px-2" id="navbarTogglerDemo03">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link fw-bold active" aria-current="page" href="/admin/home">Pocetna</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{route('admin.orders.index')}}">Kupovine</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{route('admin.toys.index')}}">Igracke</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{route('admin.categories.index')}}" tabindex="-1" aria-disabled="true">Kategorije</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="{{route('admin.subcategories.index')}}" tabindex="-1" aria-disabled="true">Potkategorije</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold" href="/" tabindex="-1" aria-disabled="true">Prodavnica</a>
                        </li>
                    </ul>
                    <form action="{{route('logout')}}" method="POST" class="d-flex">
                        @csrf
                        <button class="btn btn-link text-dark" type="submit">Odjavi se</button>
                    </form>
                </div>
            </div>
        </nav>
        <main class="container px-2 py-5">
            @yield('content')
        </main>
        <footer class="text-muted rounded footer shadow-lg sticky-bottom container px-4 mt-5">
            <div class="container">
                <p class="ms-2 my-auto d-flex justify-content-between py-4"><span class="my-auto">&copy;
                        {{Date::now()->format('Y')}}. Sva
                        prava zadrzana.</span> <a href="#" class="btn btn-outline-dark custom-border my-auto"><i
                            class="fas fa-chevron-up    "></i></a></p>
            </div>
        </footer>
    </div>
    </div>
    </div>
</body>

</html>
