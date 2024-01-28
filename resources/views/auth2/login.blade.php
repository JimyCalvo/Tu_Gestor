@extends('layouts.auth')

@section('title', 'Login')

@section('content')

    <div class="container ">
        <div class="row align-items-center justify-content-center ">
            <div class="col-12 col-sm-9 col-md-8 col-lg-5 ">
                <div class="card bg bg-dark text-light bg-opacity-75">
                    <div class="card-body ">

                        <div class="container-fluid text-center">
                            <img src="{{ asset('images/logo-night.png') }}" alt="Logo"
                                style="width: 100px; margin-bottom: 20px;">
                        </div>


                        <h5 class="card-title text-center mb-3">Iniciar Sesión</h5>

                        <div id="errorMessages"></div>

                        <form id="ajaxLoginForm">
                            @csrf

                            <div class="mb-3 ps-1 pe-1 ps-sm-2 pe-sm-2 ps-md-4 pe-md-4 ps-lg-5 pe-lg-5">
                                <div class="input-group  ">
                                    <span class="input-group-text bg-dark bg-opacity-75 text-white">
                                        <i class="bi bi-person-fill"></i>
                                    </span>
                                    <input type="text" class="form-control bg-dark text-white rounded-end bg-opacity-75 text-center"
                                        id="user_credential" name="user_credential"  placeholder="Usuario / Email">
                                </div>
                            </div>

                            <div class="mb-3 ps-1 pe-1 ps-sm-2 pe-sm-2 ps-md-4 pe-md-4 ps-lg-5 pe-lg-5">
                                <div class="input-group ">
                                    <span class="input-group-text bg-dark text-white bg-opacity-75">
                                        <i class="bi bi-lock-fill"></i>
                                    </span>
                                    <input type="password" class="form-control bg-dark text-white bg-opacity-75 text-center "
                                        id="password" name="password"  placeholder="Contraseña">
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <div class="col-12 text-start ps-5">
                                    <a href="{{ route('password.request') }}" class="btn btn-link text-light pe-5">¿Olvidaste tu
                                        contraseña?</a>
                                </div>

                            </div>
                            <br>
                            <div class="container text-center">
                                <button type="submit" class="btn btn-primary mt-3 ">Iniciar Sesión</button>
                            </div>
                        </form>

                        <br>
                        <hr>

                        <p class="text-center align-items-center"> <span>No tienes una cuenta? </span><a href="{{ route('register') }}"
                                class="btn btn-link text-white">Regístrate</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .input-group-text,
        .form-control {
            border: none;
        }

        .form-control::placeholder {
            color: white;
            opacity: 1;
        }


    </style>
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/gestor/login.js') }}"></script>
@endsection



