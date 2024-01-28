@extends('layouts.auth')
@section('title', 'Verification Email')
@section('content')
<!-- Botón para volver a la página de bienvenida -->
<div class="row mb-3">
    <div class="col-md-12 ms-5">
        <a href="{{ url('/') }}" class="btn btn-outline-light">
            <h6><i class="bi bi-house"></i> Volver Inicio</h6>
        </a>
    </div>
</div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-10 col-sm-8 col-md-6 justify-content-center">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Verificar Email</h5>
                        <p class="card-text">Por favor verifica tu cuenta en tu dirección de correo electrónico: <b>{{$email}}</b></p>
                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('verification.resend') }}">
                            <input type="hidden" name="id" value="{{$id}}">
                            <input type="hidden" name="email" value="{{$email}}">
                            @csrf
                            <button type="submit" class="btn btn-dark"> <i class="bi bi-envelope"></i> Reenviar Email de Verificación</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
