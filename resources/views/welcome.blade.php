@extends('layouts.guest')
@section('title', 'Welcome')
@section('content')
    <div
        style="background: linear-gradient(90deg, rgba(255,53,109,1) 0%, rgba(255,91,46,1) 50%, rgba(254,218,117,1) 100%); height: 100vh; width: 100vw; overflow-x: hidden; overflow-y: auto; box-sizing: border-box; ">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark bg-opacity-75 m-0 ">
            <div class="container">
                <!-- Logo and brand name -->
                <a class="navbar-brand" href="/">
                    <img src="{{ URL::asset('images/logo-night.png') }}" alt="Logo" style="height: 30px;">
                    Tu Gestor
                </a>

                <!-- Toggler/collapsible Button for mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar links -->
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">

                        @auth
                            <li class="nav-item">
                                <a class="nav-link"href="{{ route('home') }}">Hogar</a>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" id="logoutButton" class=" nav-link btn btn-link"
                                        style="text-decoration: none;">
                                        Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        @endauth
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Inicia sesión</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Regístrate</a>
                            </li>
                        @endguest

                    </ul>
                </div>
            </div>
        </nav>

        <div id="successMessage" class="d-none alert alert-success alert-dismissible fade show floating-alert opacity-50 "
            role="alert">
            <!-- El mensaje de éxito se insertará aquí -->
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <div class="row align-items-center justify-content-center mt-5 pt-5">
            <div class="col-10 col-md-8 text-center">
                <h1 class="display-1 text-white fw-bold">Tu Gestor</h1>
                <h3 class="lead text-white">Flexibilidad en cada artículo, claridad en cada acción. Su inventario, a su
                    medida</h3>
                <br>
                <a href="#" class="btn btn-dark  btn-lg">
                    <h6>Mas Información </h6>
                </a>
            </div>
            @auth
                <!-- Código para usuarios autenticados -->
                <p>El usuario está autenticado.</p>
            @else
                <!-- Código para usuarios no autenticados -->
                <p>El usuario no está autenticado.</p>
            @endauth
        </div>
    </div>
@endsection

<script src="{{ asset('js/jquery.js') }}"></script>
<script>
    $(document).ready(function() {

        var successMessage = localStorage.getItem('logoutSuccess');
        if (successMessage) {
            $('#successMessage').text(successMessage).removeClass('d-none');
            localStorage.removeItem('logoutSuccess');
        }


    });
</script>
