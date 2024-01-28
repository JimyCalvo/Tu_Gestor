<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <link rel="icon" href={{ URL::asset('images/logo.png') }} type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Tu Gestor')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

</head>

<body
    style="background: linear-gradient(90deg, rgba(255,53,109,1) 0%, rgba(255,91,46,1) 50%, rgba(254,218,117,1) 100%); height: 100vh; width: 100vw; overflow-x: hidden; overflow-y: auto; box-sizing: border-box; ">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-opacity-75">
        <div class="container-fluid">

            <a class="navbar-brand" href="{{ route('welcome') }}">
                <img src="{{ URL::asset('images/logo-night.png') }}" alt="Logo" style="height: 30px;">
                Tu Gestor
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Enlaces de la navbar -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item pe-5">
                        <a class="nav-link" href="{{ route('welcome') }}">
                            <i class="bi bi-house-door-fill"></i> Home
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <div class="container-fluid mt-4">
        @yield('content')
    </div>


    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>

</body>

</html>
