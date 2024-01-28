<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{ URL::asset('images/logo.png') }}" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Tu Gestor')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/menu.css') }}" rel="stylesheet">


</head>

<body>

    <div id="wrapper">
        <div class="overlay"></div>
        <nav class="navbar navbar-inverse fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <div class="sidebar-header">
                    <div class="sidebar-brand">
                        <a href="#">Brand</a>
                    </div>
                </div>
                <li><a href="#home">Home</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/users') }}">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/areas') }}">Áreas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/repositories') }}">Repositorios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/inventories') }}">Inventarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/categories') }}">Categorías</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/manufacturers') }}">Fabricantes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/search') }}">Búsqueda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/suppliers') }}">Proveedores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/item-data') }}">Datos de Artículos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/items') }}">Artículos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/others') }}">Otros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/inventory-entries') }}">Entradas de Inventario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/inventory-exits') }}">Salidas de Inventario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/item-histories') }}">Historial de Artículos</a>
                </li>
                <li><a href="{{ url('/areas') }}">Áreas</a></li>

                <hr>
                <p>______________________________________</p>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/inventory-exits') }}">Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/inventory-exits') }}">Ajuste</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/inventory-exits') }}">Cerrar Sesión</a>
                </li>

            </ul>
        </nav>


        <!-- Page Content -->
        <div id="page-content-wrapper">
            <button type="button" class="hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
                <span class="hamb-top"></span>
                <span class="hamb-middle"></span>
                <span class="hamb-bottom"></span>
            </button>
            <div class="container text-ligth">
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    @yield('content')
                </main>
            </div>
        </div>


    </div>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>


    <script src="{{ asset('js/jquery.js') }}"></script>
    <script>
        $(document).ready(function() {
            var trigger = $('.hamburger'),
                overlay = $('.overlay'),
                isClosed = false;

            trigger.click(function() {
                hamburger_cross();
            });

            function hamburger_cross() {
                if (isClosed == true) {
                    overlay.hide();
                    trigger.removeClass('is-open');
                    trigger.addClass('is-closed');
                    isClosed = false;
                } else {
                    overlay.show();
                    trigger.removeClass('is-closed');
                    trigger.addClass('is-open');
                    isClosed = true;
                }
            }

            $('[data-toggle="offcanvas"]').click(function() {
                $('#wrapper').toggleClass('toggled');
            });
        });
    </script>
</body>

</html>
