<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'LenteraMu') }}</title>

    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html {
            scroll-behavior: smooth;
            overflow-x: hidden;
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
            background: linear-gradient(135deg, #fff7e6, #fef3c7);
            overflow-x: hidden;
        }

        .navbar-custom {
            backdrop-filter: blur(15px);
            background: rgba(255, 255, 255, 0.85);
        }

        .hero {
            padding-top: 120px;
        }

        .full-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 100px 20px;
        }

        .full-section .container {
            width: 100%;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            color: #7c2d12;
        }

        .hero-sub {
            font-size: 1.1rem;
            color: #6b7280;
        }

        .btn-main {
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 500;
        }

        .blob {
            position: absolute;
            top: -150px;
            right: -150px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, #facc15, transparent 70%);
            z-index: 0;
        }

        .hero .container {
            position: relative;
            z-index: 2;
        }

        .feature-card {
            border-radius: 20px;
            transition: 0.4s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        footer {
            background: bisque;
        }

        .feature-modern {
            border-radius: 25px;
            transition: all .4s ease;
            background: white;
        }

        .feature-modern:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
        }

        .icon-circle {
            width: 70px;
            height: 70px;
            margin: auto;
            border-radius: 50%;
            background: linear-gradient(135deg, #facc15, #f59e0b);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: white;
        }

        .step-box {
            background: white;
            padding: 40px;
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
            transition: .4s ease;
            position: relative;
            z-index: 2;
        }

        .step-box:hover {
            transform: translateY(-10px);
        }

        .step-number {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #facc15, #f59e0b);
            border-radius: 50%;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.5rem;
            color: white;
        }

        .nav-link-custom {
            position: relative;
            text-decoration: none;
            color: #000;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-block;
        }
        
        .nav-link-custom:hover {
            color: #facc15;
            transform: translateY(-3px);
        }

        .nav-link-custom::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -4px;
            width: 0%;
            height: 2px;
            background: #facc15;
            transition: width 0.3s ease;
        }

        .nav-link-custom:hover::after {
            width: 100%;
        }

        .scroll-down-arrow {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            text-decoration: none;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 10;
            transition: all 0.3s ease;
        }

        .scroll-down-arrow:hover {
            color: #198754;
            bottom: 25px;
        }

        .mouse {
            width: 25px;
            height: 40px;
            border: 2px solid #333;
            border-radius: 20px;
            position: relative;
            margin-bottom: 5px;
        }

        .wheel {
            width: 4px;
            height: 8px;
            background-color: #333;
            border-radius: 2px;
            position: absolute;
            top: 6px;
            left: 50%;
            transform: translateX(-50%);
            animation: mouseWheel 1.5s infinite;
        }

        .arrow-down {
            font-size: 1.2rem;
            animation: arrowDown 1.5s infinite;
        }

        @keyframes mouseWheel {
            0% {
                top: 6px;
                opacity: 1;
            }

            100% {
                top: 18px;
                opacity: 0;
            }
        }

        @keyframes arrowDown {
            0% {
                transform: translateY(0);
                opacity: 0.5;
            }

            50% {
                transform: translateY(5px);
                opacity: 1;
            }

            100% {
                transform: translateY(0);
                opacity: 0.5;
            }
        }

        @media (max-width:768px) {
            .hero-title {
                font-size: 2rem;
            }

            .scroll-down-arrow {
                bottom: 20px;
                padding-bottom: 50px;
            }

            .mouse {
                width: 20px;
                height: 35px;
            }

            .arrow-down {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-warning" href="#">
                📚 {{ config('app.name', 'LenteraMu') }}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navMenu">
                @if (Route::has('login'))
                <div class="d-flex gap-4">
                    @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-sm btn-outline-danger">
                            Logout
                        </button>
                    </form>
                    @else
                    <a href="#halaman-utama" class="nav-link-custom">
                        Halaman Utama
                    </a>
                    <a href="#fitur-unggulan" class="nav-link-custom">
                        Fitur Unggulan
                    </a>
                    <a href="#cara-kerja" class="nav-link-custom">
                        Cara Kerja
                    </a>
                    <a href="#footer" class="nav-link-custom">
                        Tentang Kami
                    </a>
                    @endauth
                </div>
                @endif
            </div>
        </div>
    </nav>

    <section class="hero full-section position-relative" id="halaman-utama" style="min-height: 100vh; display: flex; align-items: center;">
        <div class="blob"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center text-lg-start" data-aos="fade-right">
                    <h1 class="hero-title mb-4">
                        Selamat Datang di {{ config('app.name', 'LenteraMu') }}!
                    </h1>
                    <p class="hero-sub mb-4">
                        Platform pintar untuk mengelola peminjaman, pengembalian, dan koleksi buku sekolah secara efisien dan profesional.
                    </p>
                    <div class="d-flex gap-3 flex-wrap justify-content-center justify-content-lg-start">
                        @auth
                        @if(auth()->user()->role == 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-success btn-main"> Buka Dashboard Admin </a>
                        @else
                        <a href="{{ route('user.dashboard') }}" class="btn btn-success btn-main"> Buka Dashboard </a>
                        @endif
                        @else
                        <a href="{{ route('login') }}" class="btn btn-success btn-main"> login murid </a>
                        <a href="{{ route('admin.login') }}" class="btn btn-outline-dark btn-main"> login admin </a>
                        @endauth
                    </div>

                    <div class="row mt-5 text-center text-lg-start">
                        <div class="col-4">
                            <h4 class="fw-bold text-warning">{{ $totalBuku }}+</h4>
                            <small class="text-muted">Total Buku</small>
                        </div>
                        <div class="col-4">
                            <h4 class="fw-bold text-success">{{ $totalAnggota }}+</h4>
                            <small class="text-muted">Anggota</small>
                        </div>
                        <div class="col-4">
                            <h4 class="fw-bold text-danger">{{ $totalTransaksi }}+</h4>
                            <small class="text-muted">Transaksi</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 text-center mt-5 mt-lg-0" data-aos="fade-left">
                    <svg width="350" viewBox="0 0 512 512">
                        <circle cx="256" cy="256" r="200" fill="#fde68a" />
                        <rect x="170" y="200" width="170" height="120" fill="#f59e0b" rx="10" />
                        <circle cx="256" cy="170" r="40" fill="#92400e" />
                        <rect x="220" y="240" width="90" height="15" fill="white" />
                        <rect x="220" y="270" width="90" height="15" fill="white" />
                    </svg>
                </div>
            </div>
        </div>

        <a href="#fitur-unggulan" class="scroll-down-arrow" aria-label="Scroll ke bawah">
            <div class="mouse">
                <div class="wheel"></div>
            </div>
            <div class="arrow-down">
                <i class="fas fa-chevron-down"></i>
            </div>
        </a>
    </section>

    <section class="full-section position-relative overflow-hidden" style="background: linear-gradient(135deg,#ffffff,#fff7ed);" id="fitur-unggulan">

        <div style="position:absolute; top:-150px; right:-150px; width:400px; height:400px; background:#fde68a; filter:blur(120px); opacity:.5;"></div>

        <div class="container text-center position-relative">

            <h2 class="fw-bold mb-3" data-aos="fade-up">
                Fitur Unggulan
            </h2>
            <p class="text-muted mb-5" data-aos="fade-up" data-aos-delay="100">
                Dirancang untuk mempermudah pengelolaan perpustakaan secara modern dan efisien
            </p>

            <div class="row g-4 justify-content-center">

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card border-0 shadow-lg p-5 h-100 feature-modern">
                        <div class="icon-circle mb-4">
                            📖
                        </div>
                        <h5 class="fw-semibold mb-3">Manajemen Buku</h5>
                        <p class="text-muted">
                            Kelola koleksi buku secara digital dengan sistem yang terorganisir dan mudah digunakan.
                        </p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="card border-0 shadow-lg p-5 h-100 feature-modern">
                        <div class="icon-circle mb-4">
                            🔄
                        </div>
                        <h5 class="fw-semibold mb-3">Peminjaman Online</h5>
                        <p class="text-muted">
                            Proses peminjaman dan pengembalian lebih cepat, transparan, dan terdokumentasi.
                        </p>
                    </div>
                </div>

                <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="card border-0 shadow-lg p-5 h-100 feature-modern">
                        <div class="icon-circle mb-4">
                            📊
                        </div>
                        <h5 class="fw-semibold mb-3">Dashboard Statistik</h5>
                        <p class="text-muted">
                            Pantau aktivitas perpustakaan secara real-time dengan visualisasi data yang informatif.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="full-section position-relative" style="background: linear-gradient(135deg,#fef3c7,#ffffff);" id="cara-kerja">
        <div class="container text-center">
            <h2 class="fw-bold mb-3" data-aos="fade-up"> Cara Kerja Sistem </h2>
            <p class="text-muted mb-5" data-aos="fade-up" data-aos-delay="100"> Hanya dalam beberapa langkah mudah untuk menggunakan sistem </p>

            <div class="row justify-content-center position-relative g-4">

                <div class="d-none d-md-block" style="position:absolute; top:45%; left:0; right:0; height:4px; background:#facc15; z-index:0;"></div>

                <div class="col-md-3 d-flex" data-aos="zoom-in">
                    <div class="step-box w-100 d-flex flex-column bg-white p-4 shadow-sm rounded-4" style="z-index:1;">
                        <div class="step-number mx-auto">1</div>
                        <h5 class="fw-semibold mt-4">Login Akun</h5>
                        <p class="text-muted mb-0"> Gunakan NIS untuk login ke akun yang sudah disediakan oleh sekolahan. </p>
                    </div>
                </div>

                <div class="col-md-3 d-flex" data-aos="zoom-in" data-aos-delay="150">
                    <div class="step-box w-100 d-flex flex-column bg-white p-4 shadow-sm rounded-4" style="z-index:1;">
                        <div class="step-number mx-auto">2</div>
                        <h5 class="fw-semibold mt-4">Daftar Sebagai Anggota</h5>
                        <p class="text-muted mb-0"> Daftar sebagai anggota perpustakaan untuk mendapatkan akses penuh ke fitur peminjaman. </p>
                    </div>
                </div>

                <div class="col-md-3 d-flex" data-aos="zoom-in" data-aos-delay="300">
                    <div class="step-box w-100 d-flex flex-column bg-white p-4 shadow-sm rounded-4" style="z-index:1;">
                        <div class="step-number mx-auto">3</div>
                        <h5 class="fw-semibold mt-4">Pilih Buku</h5>
                        <p class="text-muted mb-0"> Pilih buku yang ingin dipinjam dari ribuan koleksi daftar yang tersedia. </p>
                    </div>
                </div>

                <div class="col-md-3 d-flex" data-aos="zoom-in" data-aos-delay="450">
                    <div class="step-box w-100 d-flex flex-column bg-white p-4 shadow-sm rounded-4" style="z-index:1;">
                        <div class="step-number mx-auto">4</div>
                        <h5 class="fw-semibold mt-4">Konfirmasi Admin</h5>
                        <p class="text-muted mb-0"> Admin menyetujui dan buku siap untuk diambil di perpustakaan. </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <footer class="text-center py-4 text-muted small" id="footer">
        © {{ date('Y') }} {{ config('app.name') }} By Depaa — Digital Library System
    </footer>

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>

</body>

</html>