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
                        <li class="nav-item auth-item" style="display: none;">
                            <a class="nav-link" href="/ ">Hogar</a>
                        </li>
                        <li class="nav-item auth-item" style="display: none;">
                                <button type="submit" id="logoutButton" class="nav-link btn btn-link" style="text-decoration: none;">
                                    Cerrar Sesión
                                </button>

                        </li>

                        <!-- Items para invitados -->
                        <li class="nav-item guest-item">
                            <a class="nav-link" href="{{ route('login') }}">Inicia sesión</a>
                        </li>
                        <li class="nav-item guest-item">
                            <a class="nav-link" href="{{ route('register') }}">Regístrate</a>
                        </li>
                    </ul>

                    </ul>
                </div>
            </div>
        </nav>

        <div id="successMessage" class="d-none alert alert-success alert-dismissible fade show floating-alert opacity-50 " role="alert">
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

        </div>
    </div>
@endsection

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/gestor/logout.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var token = localStorage.getItem('token'); // Asumiendo que el token se guarda en localStorage
        var authItems = document.querySelectorAll('.auth-item');
        var guestItems = document.querySelectorAll('.guest-item');

        if (token) {
            // Usuario autenticado
            authItems.forEach(item => item.style.display = 'block');
            guestItems.forEach(item => item.style.display = 'none');
        } else {
            // Invitado
            authItems.forEach(item => item.style.display = 'none');
            guestItems.forEach(item => item.style.display = 'block');
        }
    });
</script>



