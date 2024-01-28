@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">SuperAdministrador</div>
                <div class="card-body">

                    <p>{{ __('Bienvenido') }}, {{ auth()->user()->name }}!</p>
                    <p> {{ auth()->user()->role->name }}</p>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">{{ __('Logout') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Menú API</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/areas">Áreas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/categories">Categorías</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/extra-title">Títulos Extras</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/inventory">Inventario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/inventory-entry">Entradas de Inventario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/inventory-exits">Salidas de Inventario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/items-data">Datos de Artículos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/items">Artículos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/others">Otros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/manufacturers">Fabricantes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/repositories">Repositorios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/suppliers">Proveedores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/item_histories">Historial de Artículos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endsection
