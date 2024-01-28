@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Administrador</div>
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
@endsection
