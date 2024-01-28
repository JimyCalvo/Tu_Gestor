@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-light bg-opacity-75">
                <div class="card-header text-center"><b>{{ __('Restablecer Contraseña') }}</b></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-3 ps-4 pe-4">
                            <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ request()->query('email') ?? old('email') }}" required>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 ps-4 pe-4">
                            <label for="password" class="form-label">{{ __('Contraseña') }}</label>

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required ="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 ps-4 pe-4">
                            <label for="password-confirm" class="form-label">{{ __('Confirmar Contraseña') }}</label>

                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <br>

                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Restablecer Contraseña') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
