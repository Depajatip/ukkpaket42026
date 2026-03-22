@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

<style>
    body {
        background: linear-gradient(135deg, #667eea, #764ba2);
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* Background blur blob */
    .bg-blob {
        position: fixed;
        width: 350px;
        height: 350px;
        background: #facc15;
        border-radius: 50%;
        filter: blur(120px);
        opacity: 0.25;
        animation: float 10s ease-in-out infinite;
    }

    .blob1 {
        top: -100px;
        left: -100px;
    }

    .blob2 {
        bottom: -100px;
        right: -100px;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(30px);
        }
    }

    /* Glass hero */
    .hero {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        border-radius: 25px;
        padding: 35px;
        color: white;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
    }

    /* Identity cards */
    .identity-card {
        background: white;
        border-radius: 20px;
        padding: 25px;
        transition: 0.3s;
        height: 100%;
    }

    .identity-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    /* Feature card */
    .feature-card {
        background: white;
        border-radius: 25px;
        padding: 30px;
        transition: 0.3s;
        height: 100%;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    }

    /* Activity box */
    .activity-box {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(15px);
        border-radius: 25px;
        padding: 30px;
        color: white;
    }

    .daftar-card {
        background: linear-gradient(135deg, #4e73df, #1cc88a);
        color: white;
        border-radius: 20px;
        overflow: hidden;
    }

    .daftar-card p {
        color: rgba(255, 255, 255, 0.9);
    }

    .daftar-btn {
        background: white;
        color: #1cc88a;
        font-weight: bold;
        transition: 0.3s ease;
    }

    .daftar-btn:hover {
        transform: scale(1.05);
        background: #f8f9fc;
    }

    /* Card Statistik Baru */
    .stat-card {
        background: rgba(255, 255, 255, 0.2);
        /* Glass effect */
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 20px;
        padding: 20px;
        color: white;
        transition: 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.25);
    }

    .stat-icon {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1.2rem;
        margin-bottom: 15px;
    }

    /* Warna icon disesuaikan agar tetap cerah di bg gelap */
    .bg-info-light {
        background: rgba(0, 212, 255, 0.3);
        color: #00d4ff;
    }

    .bg-warning-light {
        background: rgba(255, 193, 7, 0.3);
        color: #ffc107;
    }

    .bg-success-light {
        background: rgba(40, 167, 69, 0.3);
        color: #28a745;
    }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 800;
        line-height: 1;
    }

    .stat-label {
        font-size: 0.85rem;
        opacity: 0.8;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    @media(max-width:768px) {
        .hero {
            padding: 25px;
        }
    }
</style>

<div class="bg-blob blob1"></div>
<div class="bg-blob blob2"></div>

<div class="container py-5 position-relative" style="z-index:2;">

    <!-- HERO -->
    <div class="hero mb-5" data-aos="fade-up">
        <div class="col-md-6">
            <h3 class="fw-bold">
                👋 Halo, {{ auth()->user()->nama_siswa }}
            </h3>
            <p class="mb-0">
                Selamat datang di Sistem Perpustakaan Digital
            </p>
        </div>
    </div>

    <!-- IDENTITAS MURID -->
    <div class="row g-4 mb-5">

        <div class="col-md-4" data-aos="fade-up">
            <div class="identity-card">
                <small class="text-muted">NIS</small>
                <h5 class="fw-bold mt-2">{{ auth()->user()->nis }}</h5>
            </div>
        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="identity-card">
                <small class="text-muted">Kelas</small>
                <h5 class="fw-bold mt-2">{{ auth()->user()->kelas }}</h5>
            </div>
        </div>

        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="identity-card">
                <small class="text-muted">Status Anggota</small>
                <div class="mt-2">
                    @if(auth()->user()->anggota)
                    <span class="badge bg-success px-3 py-2">✔ Aktif</span>
                    @else
                    <span class="badge bg-danger px-3 py-2">✖ Belum Aktif</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-6 col-md-4" data-aos="zoom-in" data-aos-delay="300">
            <div class="stat-card">
                <div class="stat-icon bg-info-light">
                    <i class="fas fa-book-reader"></i>
                </div>
                <div class="stat-label">Dipinjam</div>
                <div class="stat-value">{{ $jumlahDipinjam ?? 0 }}</div>
            </div>
        </div>

        <div class="col-6 col-md-4" data-aos="zoom-in" data-aos-delay="400">
            <div class="stat-card">
                <div class="stat-icon bg-warning-light">
                    <i class="fas fa-hourglass-half"></i>
                </div>
                <div class="stat-label">Menunggu</div>
                <div class="stat-value">{{ $jumlahMenunggu ?? 0 }}</div>
            </div>
        </div>

        <div class="col-12 col-md-4" data-aos="zoom-in" data-aos-delay="500">
            <div class="stat-card">
                <div class="stat-icon bg-success-light">
                    <i class="fas fa-check-double"></i>
                </div>
                <div class="stat-label">Selesai</div>
                <div class="stat-value">{{ $jumlahKembali ?? 0 }}</div>
            </div>
        </div>
    </div>


    <!-- FITUR UTAMA -->
    @php
    $isActive = auth()->user()->anggota
    && auth()->user()->anggota->status_anggota === 'aktif';
    @endphp

    {{-- FITUR DAFTAR ANGGOTA --}}
    @if(!$isActive)
    <div class="row mb-5" data-aos="fade-up">
        <div class="col-12 ">
            <div class="card shadow-lg border-0 text-center p-5 position-relative daftar-card">

                <h4 class="fw-bold mb-3">
                    Kamu Belum Terdaftar Sebagai Anggota
                </h4>

                <p class="text-muted mb-4">
                    Daftarkan dirimu sekarang agar bisa meminjam buku dan menikmati semua fitur perpustakaan.
                </p>

                <a href="{{ route('anggota.create') }}"
                    class="btn btn-lg btn-success rounded-pill px-5 shadow-sm daftar-btn">
                    🚀 Daftar Anggota Sekarang
                </a>

            </div>
        </div>
    </div>
    @endif

    <div class="row g-4 mb-5">

        {{-- LIHAT BUKU --}}
        <div class="col-md-4" data-aos="zoom-in">
            <div class="feature-card text-center">
                <h5>📚 Lihat Buku</h5>
                <p class="text-muted small">
                    Jelajahi seluruh koleksi buku
                </p>

                @if($isActive)
                <a href="/buku"
                    class="btn btn-primary rounded-pill px-4">
                    Buka
                </a>
                @else
                <button class="btn btn-secondary rounded-pill px-4" disabled>
                    Daftar Anggota Dulu
                </button>
                @endif

            </div>
        </div>


        {{-- PEMINJAMAN --}}
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
            <div class="feature-card text-center">
                <h5>🔄 Peminjaman</h5>
                <p class="text-muted small">
                    Lihat transaksi berjalan
                </p>

                @if($isActive)
                <a href="{{ route('siswa.peminjaman') }}"
                    class="btn btn-outline-primary rounded-pill px-4">
                    Lihat
                </a>
                @else
                <button class="btn btn-secondary rounded-pill px-4" disabled>
                    Daftar Anggota Dulu
                </button>
                @endif

            </div>
        </div>


        {{-- RIWAYAT --}}
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
            <div class="feature-card text-center">
                <h5>📜 Riwayat</h5>
                <p class="text-muted small">
                    Riwayat peminjaman kamu
                </p>

                @if($isActive)
                <a href="{{ route('siswa.history') }}"
                    class="btn btn-outline-secondary rounded-pill px-4">
                    Lihat
                </a>
                @else
                <button class="btn btn-secondary rounded-pill px-4" disabled>
                    Daftar Anggota Dulu
                </button>
                @endif

            </div>
        </div>

    </div>

    <!-- AKTIVITAS -->
    <div class="activity-box" data-aos="fade-up">
        <h5 class="fw-bold mb-3">🔔 Aktivitas Terbaru</h5>
        <ul class="list-unstyled mb-0">
            @if($isActive)
            @forelse($aktivitas as $a)
            <li class="mb-2">
                📚 Kamu meminjam buku <b>{{ $a->buku->judul_buku }}</b>
            </li>
            @empty
            <li>Tidak ada aktivitas</li>
            @endforelse
            @else
            <button class="btn btn-secondary rounded-pill px-4" disabled>
                Daftar Anggota Dulu
            </button>
            @endif
        </ul>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 900,
        once: true
    });
</script>

@endsection