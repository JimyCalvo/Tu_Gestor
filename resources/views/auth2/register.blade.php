@extends('layouts.auth')
@section('title', 'Register')
@section('content')
    <div class="container mt-3">
        <div class="row">
                 <!-- Muestra los errores de validación -->
            @include('components.errores')

            <div class="col-lg-6 offset-lg-3 bg-dark bg-opacity-75 text-light ps-5 pe-5 pt-3 pb-3">
                <div class="container-fluid text-center">
                    <img src="{{ asset('images/logo-night.png') }}" alt="Logo" style="width: 100px; margin-bottom: 20px;">
                </div>
                <h1 class="text-center">Registrar</h1>


                <!-- Formulario de registro -->
                <form id="registerForm">


                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control bg-dark bg-opacity-50 text-light border-dark"
                            id="username" name="username" value="{{ old('username') }}" maxlength="40">
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="name" class="form-label">Nombres:</label>
                            <input type="text" class="form-control bg-dark bg-opacity-50 text-light border-dark"
                                id="name" name="name" value="{{ old('name') }}" maxlength="40">
                        </div>
                        <div class="col-sm-6">
                            <label for="last_name" class="form-label">Apellidos:</label>
                            <input type="text" class="form-control bg-dark bg-opacity-50 text-light border-dark"
                                id="last_name" name="last_name" value="{{ old('last_name') }}" maxlength="40">
                        </div>

                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico:</label>
                        <input type="email" class="form-control bg-dark bg-opacity-50 text-light border-dark"
                            id="email" name="email" value="{{ old('email') }}" maxlength="80">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña:</label>
                        <input type="password" class="form-control bg-dark bg-opacity-50 text-light border-dark"
                            id="password" name="password" minlength="8">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña:</label>
                        <input type="password" class="form-control bg-dark bg-opacity-50 text-light border-dark"
                            id="password_confirmation" name="password_confirmation" minlength="8">
                    </div>
                    <div class="pt-3 pb-2 text-center">
                        <button type="submit" class="btn btn-dark btn-lg">Crear usuario</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/gestor/register.js') }}"></script>
