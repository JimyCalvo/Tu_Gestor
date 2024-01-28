@extends('layouts.auth')

@section('content')
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg bg-dark  bg-opacity-75 text-light">
                    <div class="card-header text-center"> <b>Restablecer la contraseña</b></div>
                    <div class="card-body">
                        <p>Ingrese su correo electrónico:</p>
                        <form id="passwordEmailForm" class="text-center ps-5 pe-5">
                            <input type="email" id="email" class="form-control ps-5 pe-5" required>
                            <button type="submit" class="btn btn-dark mt-4">Enviar enlace de restablecimientoa</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('passwordEmailForm').addEventListener('submit', function(event) {
            event.preventDefault();

            fetch('/api/password/email', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    email: document.getElementById('email').value
                })
            })
            .then(response => response.json())
            .then(data => {
                // Handle response
                console.log(data);
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
