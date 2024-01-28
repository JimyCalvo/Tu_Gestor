@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Actualizar Perfil</h2>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            {{-- Mensajes de error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Mensaje de éxito --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Campos del formulario --}}
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', auth()->user()->name) }}">
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="last_name" name="last_name"
                    value="{{ old('last_name', auth()->user()->last_name) }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ old('email', auth()->user()->email) }}">
            </div>

            {{-- Añade más campos según sea necesario --}}

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
