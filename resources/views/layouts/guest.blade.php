<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <link rel="icon" href="{{URL::asset('images/logo.png')}}" type="image/x-icon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Tu Gestor')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

</head>

<body class="d-block bg-dark text-light">
        @yield('content')
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
