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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.document-type').forEach(function (button) {
                button.addEventListener('click', function () {
                    document.getElementById('is_passport').value = this.getAttribute('data-is-passport');
                });
            });
        });
    </script>
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



    <div class="container mt-4 p-5 bg bg-dark bg-opacity-75">
        <div class="container text-light">
            <h2 class="text-center">Crear Perfil</h2>

            <div id="errorMessages"></div>


            <form id="profileCreationForm">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Número de Documento" aria-label="Número de Documento" name="dni_number">
                    <div class="input-group-text  bg-dark text-light bg-opacity-50">
                        <input class="form-check-input mt-0" type="checkbox" value="1" name="is_passport" aria-label="Checkbox for passport">
                        <label class="ps-3 "> Pasaporte </label>
                    </div>
                </div>


                <div class="mb-3">
                    <label for="phone_user" class="form-label">Teléfono (Opcional)</label>
                    <input type="text" class="form-control {{ $errors->has('phone_user') ? 'is-invalid' : '' }}"
                        id="phone_user" name="phone_user" value="{{ old('phone_user') }}">
                </div>

                <div class="mb-3">
                    <label for="tel_user" class="form-label">Teléfono Fijo</label>
                    <input type="text" class="form-control {{ $errors->has('tel_user') ? 'is-invalid' : '' }}"
                        id="tel_user" name="tel_user" value="{{ old('tel_user') }}" >

                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Dirección</label>
                    <input type="text" class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                        id="address" name="address" value="{{ old('address') }}">

                </div>

                <div class="mb-3">
                    <label for="birthday" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control {{ $errors->has('birthday') ? 'is-invalid' : '' }}"
                        id="birthday" name="birthday" value="{{ old('birthday') }}" >
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Género</label>
                    <select class="form-select {{ $errors->has('gender') ? 'is-invalid' : '' }}" id="gender"
                        name="gender" >
                        <option selected>Elige...</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Masculino</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Femenino</option>
                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Otro</option>
                    </select>

                </div>

                <div class="mb-3">
                    <label for="job_title" class="form-label">Cargo Laboral</label>
                    <input type="text" class="form-control {{ $errors->has('job_title') ? 'is-invalid' : '' }}"
                        id="job_title" name="job_title" value="{{ old('job_title') }}" >

                </div>

                <div class="mb-3">
                    <label for="tel_job" class="form-label">Teléfono del Trabajo (Opcional)</label>
                    <input type="text" class="form-control {{ $errors->has('tel_job') ? 'is-invalid' : '' }}"
                        id="tel_job" name="tel_job" value="{{ old('tel_job') }}">
                </div>

                {{-- Lista de Areas para seleccionar --}}
                <label for="areasSelect" class="form-label">Área de Trabajo</label>
                <div class="input-group">
                    <select class="form-select text-dark" id="areasSelect">
                        <option selected value="0">Elegir...</option>
                        {{-- Las opciones se añadirán dinámicamente aquí --}}
                    </select>
                    <button class="btn btn-outline-secondary text-light" onclick="agregarALista()"
                        type="button">Añadir</button>
                </div>
                <br>

                {{-- Tabla provisional para elementos seleccionados --}}
                <table id="tablaAreas" class="table">
                    <thead class=" bg bg-dark bg-opacity-50 text-light">
                        <tr class="text-center">
                            <th>Area de trabajo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Crear Perfil</button>
                </div>

            </form>
        </div>


    </div>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/gestor/areaSelection.js') }}"></script>
    <script src="{{ asset('js/gestor/documentType.js') }}"></script>
    <script src="{{ asset('js/gestor/profileForm.js') }}"></script>






</body>

</html>
