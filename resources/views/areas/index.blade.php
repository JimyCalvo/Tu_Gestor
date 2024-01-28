
@extends('layouts.app')
@section('title', 'Areas')
@section('content')
<div class="container mt-4">
    <h2>Áreas</h2>
    <a href="{{ route('areas.create') }}" class="btn btn-primary">Crear Nueva Área</a>

    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Área</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($areas as $area)
            <tr>
                <td>{{ $area->id }}</td>
                <td>{{ $area->name_area }}</td>
                <td>{{ $area->address_area }}</td>
                <td>
                    <a href="{{ route('areas.edit', $area) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('areas.destroy', $area) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
