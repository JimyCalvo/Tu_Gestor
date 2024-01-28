<!-- resources/views/areas/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Crear Área</h2>

    <form action="{{ route('areas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name_area" class="form-label">Nombre del Área</label>
            <input type="text" class="form-control" id="name_area" name="name_area" required>
        </div>

        <div class="mb-3">
            <label for="address_area" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="address_area" name="address_area" required>
        </div>

        <button type="submit" class="btn btn-primary">Crear Área</button>
    </form>
</div>
@endsection
