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
        <div class="row bg-warning border border-bottom m-0 p-0">
            <div class="container px-lg-5">
                <header class="d-flex flex-wrap justify-content-center py-4 border-bottom">
                    <div class="col-3 my-auto"><a class="text-decoration-none" href="/"><img width="35"
                                src="{{asset('/storage/images/toy-train.png')}}" alt=""></a>
                    </div>
                    <div class="col-6 position-relative h-100">
                        <form action="{{route('search')}}" method="get">
                            <div style="right: 0" class="position-absolute h-100 d-flex"><button
                                    class="btn btn-warning my-auto p-0 rounded-pill me-2" type="submit"><i
                                        class="fas fa-search fa-sm py-2 px-4"></button></i>
                            </div><input type="text" class="form-control py-2 custom-border rounded-pill w-100"
                                name="search" value="{{old('search')}}" placeholder="Pretrazi...">
                        </form>
                    </div>
                    <div class="col-3 text-end my-auto"><a href="{{route('carts.index')}}"
                            class="btn btn-outline-dark rounded-pill custom-border "><svg width="25" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg> <span
                                style="font-size: 9px;">({{auth()->check()  ? auth()->user()->cart->count() : 0}})</span></a>
                    </div>
                </header>
                <ul class="nav d-flex justify-content-center py-2">
                    <li class="me-auto dropdown"><button class="custom-border btn btn-outline-dark" type="button"
                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i class="fas fa-bars    me-1"></i> Kategorije <i
                                class="fas fa-chevron-down    ms-1"></i></button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <div id="dropdown-menu" class="row">
                                @foreach ($categories as $category)
                                <div class="col-12 col-md-6 px-4 py-2">
                                    <p class="text-dark text-uppercase fw-bold"><span
                                            class="border-secondary-70 pb-1 border-bottom">{{$category->name}}</span>
                                    </p>
                                    @foreach ($category->subcategories as $subcategory)
                                    <div class="row mb-1">
                                        <a class="small link-secondary text-decoration-none"
                                            href="{{route('shop',$subcategory->id)}}">
                                            {{$subcategory->name}}</a>
                                    </div>
                                    @endforeach
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </li>
                    <li class=""><a href="/"
                            class="nav-link px-3 py-1 text-dark {{request()->segment(1) == '' ? 'custom-border-bottom' : ''}}"
                            aria-current="page">Pocetna</a></li>
                    <li class=""><a href="/shop"
                            class="nav-link px-3 py-1 text-dark {{request()->segment(1) == 'shop' || request()->segment(1) == 'search' ? 'custom-border-bottom' : ''}}">Prodavnica</a>
                    </li>
                    <li class=""><a href="/about" class="nav-link px-3 py-1 text-dark {{request()->segment(1) == 'about' ? 'custom-border-bottom' : ''}}">O nama & Kontakt</a></li>
                    @if (auth()->check())
                    <li class=""><a href="/orders/myorders" class="nav-link px-3 py-1 text-dark {{request()->segment(2) == 'myorders' || request()->segment(2) == 'myorder' ? 'custom-border-bottom' : ''}}">Moje kupovine</a></li>
                    @if (auth()->user()->role == 'admin')
                    <li class=""><a href="/admin/home" class="nav-link px-3 py-1 text-dark">Kontrolna tabla</a></li>
                    @endif
                    <li class="ms-auto">
                        <form action="{{route('logout')}}" method="post">
                            @csrf
                            <button class="btn btn-link text-decoration-none py-1 text-dark" type="submit">Odjavi
                                se</button>
                        </form>
                    </li>
                    @else
                    <li class="ms-auto">
                        <a href="/login"
                            class="nav-link py-1 text-dark {{request()->segment(1) == 'login' ? 'custom-border-bottom' : ''}}">Prijavi
                            se</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>

        <main>
            @yield('content')
        </main>
        <div class="container mt-5">
            <div class="row d-flex justify-content-md-between m-0">
                <div class="col-12 col-lg-4 pe-lg-4">
                    <div class="row py-3 rounded shadow-lg">
                        <div class="col-8 border-end text-center">
                            <p class="lead fw-bold">Besplatna dostava</p>
                            <p class="small">Besplatna dostava za porudzbine vece od 3000rsd.</p>
                        </div>
                        <div class="col-4 text-center my-auto"><svg width="70" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0">
                                </path>
                            </svg></div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 px-lg-4 py-4 py-lg-0">
                    <div class="row py-3 rounded shadow-lg">
                        <div class="col-8 border-end text-center">
                            <p class="lead fw-bold">Placanje karticom</p>
                            <p class="small">Svoju narudžbinu možete platiti Visa platnom karticom. </p>
                        </div>
                        <div class="col-4 text-center my-auto"><svg width="70" class="w-6 h-6" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                </path>
                            </svg></div>
                    </div>
                </div>
                <div class="col-12 col-lg-4 ps-lg-4">
                    <div class="row py-3 rounded shadow-lg">
                        <div class="col-8 border-end text-center">
                            <p class="lead fw-bold">Rok isporuke</p>
                            <p class="small">Rok isporuke porudžbina je 2 radna dana.</p>
                        </div>
                        <div class="col-4 text-center my-auto"><svg width="70" class="w-6 h-6" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg></div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="text-muted rounded footer bg-warning sticky-bottom container px-4 mt-5">
            <div class="container">
                <p class="ms-2 my-auto d-flex justify-content-between py-4"><span class="my-auto">&copy;
                        {{Date::now()->format('Y')}}. Sva
                        prava zadrzana.</span> <a href="#" class="btn btn-outline-dark custom-border my-auto"><i
                            class="fas fa-chevron-up    "></i></a></p>
            </div>
        </footer>
    </div>
</body>

</html>
