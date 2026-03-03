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
    color: rgba(255,255,255,0.9);
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

    @media(max-width:768px) {
        .hero {
            padding: 25px;
        }
    }
</style>

<div class="bg-blob blob1"></div>
<div class="bg-blob blob2"></div>

<div class="container my-5 position-relative" style="z-index:2;">

    <!-- HERO -->
    <div class="hero mb-5" data-aos="fade-up">
        <h3 class="fw-bold">
            👋 Halo, {{ auth()->user()->nama_siswa }}
        </h3>
        <p class="mb-0">
            Selamat datang kembali di Sistem Perpustakaan Digital Sekolah
        </p>
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
                <a href="{{ route('siswa.peminjaman.aktif') }}"
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
            <li class="mb-2">📚 Kamu meminjam buku <b>Algoritma Dasar</b></li>
            <li class="mb-2">🔄 Buku <b>Basis Data</b> akan jatuh tempo 3 hari lagi</li>
            <li>📌 Jangan lupa kembalikan tepat waktu ya!</li>
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