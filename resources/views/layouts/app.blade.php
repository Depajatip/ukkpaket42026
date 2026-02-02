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
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/dashboard">📚 Perpustakaan</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">

    @auth
        {{-- MENU SISWA --}}
        @if(auth()->user()->role === 'user')
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/buku">Lihat Buku</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/peminjaman">Peminjaman</a>
            </li>
        @endif

        <!-- {{-- MENU ADMIN --}}
        @if(auth()->user()->role === 'admin')
            <li class="nav-item">
                <a class="nav-link" href="/admin/dashboard">Dashboard Admin</a>
            </li>
        @endif -->

        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="btn btn-sm btn-light ms-3">Logout</button>
            </form>
        </li>
    @endauth

    @guest
        <li class="nav-item">
            <a class="nav-link" href="/">Landing page</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/login">Login Siswa</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.login') }}">Login Admin</a>
        </li>
    @endguest

</ul>

        </div>
    </div>
</nav>


    @yield('content')
    

</body>
</html>
