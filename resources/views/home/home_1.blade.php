@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-dark">
                <div class="card-header">Empleado</div>
                <div class="card-body">
                    <p>{{ __('Bienvenido') }}, {{ ucwords(strtolower(auth()->user()->full_name) )}} {{ ucwords(strtolower(auth()->user()->last_name)) }}!</p>
                    <p> {{ auth()->user()->role->name }}</p>
                    <form method="POST" action="{{ route('logout')}}">
                        @csrf
                        <button type="submit" class="btn btn-primary">{{ __('Logout') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
