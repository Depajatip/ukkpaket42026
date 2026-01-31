<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Perpustakaan') }}</title>

    {{-- Bootstrap via Vite --}}
    @vite(['resources/js/app.js'])
</head>
<body class="bg-light">

    @yield('content')

</body>
</html>
