<!-- resources/views/areas/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Editar Área</h2>

    <form action="{{ route('areas.update', $area) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name_area" class="form-label">Nombre del Área</label>
            <input type="text" class="form-control" id="name_area" name="name_area" value="{{ $area->name_area }}" required>
        </div>

        <div class="mb-3">
            <label for="address_area" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="address_area" name="address_area" value="{{ $area->address_area }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Área</button>
    </form>
</div>
@endsection
