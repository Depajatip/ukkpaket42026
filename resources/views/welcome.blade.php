<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'LenteraMu') }}</title>

    <!-- Google Font -->
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">

    @vite(['resources/js/app.js'])

    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
            background: linear-gradient(135deg, #fff7e6, #ffedd5);
        }

        .navbar-blur {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, .8);
        }

        .hero {
            padding: 120px 15px 80px;
        }

        .hero-title {
            color: #92400e;
        }

        .feature-card {
            transition: all .3s ease;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .1);
        }

        .icon {
            font-size: 3rem;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-blur fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-warning" href="#">
                📚 {{ config('app.name', 'LenteraMu') }}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navMenu">
                @if (Route::has('login'))
                <div class="navbar-nav">
                    @auth
                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="d-inline text-center">
                        @csrf
                        <button type="submit"
                            class="btn btn-outline-danger btn-mb">
                            Logout
                        </button>
                    </form>
                    @else
                    <!-- <a href="{{ route('login') }}" class="btn btn-outline-warning btn-lg">
                        Login
                    </a> -->
                    @endauth
                </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero text-center">
        <div class="container">
            <h1 class="display-5 fw-bold hero-title mb-3">
                Selamat Datang di <br> LenteraMu
            </h1>
            <p class="lead text-muted">
                Dapat digunakan untuk melihat buku yang tersedia, peminjaman buku dan pengembalian 📖
            </p>
            <!-- <p class="lead text-muted mb-5 mt-1">Daftar sebagai anggota terlebih dahulu agar dapat melakukan peminjaman buku</p> -->

            <!-- @guest
        <div class="d-flex flex-column flex-sm-row justify-content-center gap-3">
            <a href="{{ route('login') }}" class="btn btn-warning btn-lg text-white shadow">
                Masuk
            </a>
            <a href="{{ route('register') }}" class="btn btn-outline-warning btn-lg">
                Daftar Sekarang
            </a>
        </div>
        @endguest -->
            @if (Route::has('login'))
            <div class="gap-2">
                @auth
                <h5>anda sudah login, silahkan masuk ke halaman dashboard</h5>
                <br>
                <a href="{{ url('/dashboard') }}" class="btn btn-warning text-white">
                    Dashboard
                </a>
                @else
                <a href="{{ route('login') }}" class="btn btn-outline-success btn-lg">
                    Login sebagai murid
                </a>
                <a href="{{ route('admin.login') }}" class="btn btn-outline-warning btn-lg">
                    Login sebagai admin
                </a>

                <!-- @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-warning text-white btn-lg">
                    Daftar Sekarang
                </a>
                @endif -->
                @endauth
            </div>
            @endif
        </div>
    </section>

    <!-- Features -->
    <section class="pb-5">
        <div class="container">
            <div class="row g-4">

                <div class="col-md-4">
                    <div class="card feature-card h-100 border-0 rounded-4">
                        <div class="card-body text-center">
                            <div class="icon mb-3">📖</div>
                            <h5 class="fw-semibold">Koleksi Lengkap</h5>
                            <p class="text-muted">
                                Buku pelajaran, novel, dan referensi sekolah.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card feature-card h-100 border-0 rounded-4">
                        <div class="card-body text-center">
                            <div class="icon mb-3">💻</div>
                            <h5 class="fw-semibold">Akses Online</h5>
                            <p class="text-muted">
                                Bisa dibuka di HP, tablet, dan laptop.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card feature-card h-100 border-0 rounded-4">
                        <div class="card-body text-center">
                            <div class="icon mb-3">🎓</div>
                            <h5 class="fw-semibold">Dukung Belajar</h5>
                            <p class="text-muted">
                                Mendukung literasi dan pembelajaran siswa.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-4 text-muted small">
        © {{ date('Y') }} {{ config('app.name', 'LenteraMu') }} — Perpustakaan Sekolah
    </footer>
</body>

</html>