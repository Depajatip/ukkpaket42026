<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Perpustakaan') }}</title>

    {{-- Bootstrap via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- SweetAlert CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* ===== NAVBAR MODERN ===== */
        .navbar-modern {
            background: linear-gradient(135deg, #4e73df, #224abe);
        }

        .navbar-modern .nav-link {
            color: white !important;
        }

        .nav-anim {
            position: relative;
            transition: 0.3s ease;
        }

        .nav-anim::after {
            content: "";
            position: absolute;
            width: 0%;
            height: 2px;
            left: 0;
            bottom: 0;
            background-color: white;
            transition: 0.3s ease;
        }

        .nav-anim:hover {
            transform: translateY(-2px);
        }

        .nav-anim:hover::after {
            width: 100%;
        }

        .brand-hover {
            transition: 0.3s ease;
        }

        .brand-hover:hover {
            transform: scale(1.05);
        }

        .navbar-toggler {
            border: none;
        }
    </style>
</head>

<body class="bg-light">

    @php
    $user = auth()->user();
    $isActive = $user && $user->anggota && $user->anggota->status_anggota === 'aktif';
    @endphp

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark navbar-modern shadow-sm sticky-top">
        <div class="container">

            <a class="navbar-brand fw-bold brand-hover" href="/dashboard">
                📚 Perpustakaan
            </a>

            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navMenu"
                aria-controls="navMenu"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-center gap-lg-3">

                    @auth

                    {{-- USER ROLE --}}
                    @if($user->role === 'user')

                    <li class="nav-item">
                        <a class="nav-link nav-anim" href="/dashboard">Dashboard</a>
                    </li>

                    @if($isActive)

                    <li class="nav-item">
                        <a class="nav-link nav-anim" href="{{ route('buku.index') }}">Lihat Buku</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-anim" href="{{ route('siswa.peminjaman.aktif') }}">Peminjaman Aktif</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-anim" href="{{ route('siswa.history') }}">History Peminjaman</a>
                    </li>
                    @else

                    <li class="nav-item">
                        <a class="nav-link text-warning fw-bold nav-anim"
                            href="{{ route('anggota.create') }}">
                            🚀 Daftar Anggota
                        </a>
                    </li>

                    @endif

                    @endif

                    {{-- LOGOUT --}}
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-sm btn-light ms-lg-3 rounded-pill px-3">
                                Logout
                            </button>
                        </form>
                    </li>

                    @endauth

                    @guest

                    <li class="nav-item">
                        <a class="nav-link nav-anim" href="/">Landing</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-anim" href="/login">Login Siswa</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-anim"
                            href="{{ route('admin.login') }}">
                            Login Admin
                        </a>
                    </li>

                    @endguest

                </ul>
            </div>
        </div>
    </nav>

    {{-- CONTENT --}}
    @yield('content')

{{-- SWEET ALERT SUCCESS --}}
@if(session('success'))
<script>
document.addEventListener("DOMContentLoaded", function() {

    const navEntries = performance.getEntriesByType("navigation");
    if (navEntries.length > 0 && navEntries[0].type === "back_forward") {
        return;
    }

    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        confirmButtonText: 'OK'
    });

});
</script>
@endif

{{-- SWEET ALERT ERROR --}}
@if(session('error'))
<script>
document.addEventListener("DOMContentLoaded", function() {

    const navEntries = performance.getEntriesByType("navigation");
    if (navEntries.length > 0 && navEntries[0].type === "back_forward") {
        return;
    }

    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '{{ session('error') }}',
        confirmButtonText: 'OK'
    });

});
</script>
@endif

</body>

</html>