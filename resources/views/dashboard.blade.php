{{-- resources/views/dashboard.blade.php --}}

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Dashboard</h1>
                <p>Bienvenido, <span id="userName"></span>!</p>
                <button id="logoutButton" class="btn btn-danger">Cerrar Sesión</button>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/gestor/logout.js') }}"></script>
<script src="{{ asset('js/gestor/userInfo.js') }}"></script>
