@extends('layouts.app')

@section('content')
<div class="container my-4">

    {{-- Header --}}
    <div class="row mb-4">
        <div class="col">
            <h4 class="fw-bold mb-1">👋 Halo, {{ auth()->user()->nama_siswa }}</h4>
            <small class="text-muted">Selamat datang di Sistem Perpustakaan Sekolah</small>
        </div>
    </div>

    {{-- Info Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <small class="text-muted">NIS</small>
                    <h5 class="fw-semibold mb-0">{{ auth()->user()->nis }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <small class="text-muted">Kelas</small>
                    <h5 class="fw-semibold mb-0">{{ auth()->user()->kelas }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <small class="text-muted">Status Anggota</small><br>
                    @if(auth()->user()->anggota)
                        <span class="badge bg-success px-3 py-2">✔ Aktif</span>
                    @else
                        <span class="badge bg-danger px-3 py-2">✖ Belum Terdaftar</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Action Area --}}
<div class="card shadow-sm border-0">
    <div class="card-body">

        @if(!auth()->user()->anggota)
            {{-- BELUM ANGGOTA --}}
            <div class="alert alert-warning d-flex align-items-center">
                <span class="me-2 fs-4">📌</span>
                <div>
                    Kamu belum terdaftar sebagai anggota perpustakaan.
                    <br>
                    <small>Daftar dulu untuk bisa meminjam buku.</small>
                </div>
            </div>

            <div class="text-center mt-3">
                <a href="{{ route('anggota.create') }}"
                   class="btn btn-primary btn-lg px-4">
                    📖 Daftar Anggota Perpustakaan
                </a>
            </div>

            {{-- Tombol dikunci --}}
            <div class="row g-3 mt-4">
                <div class="col-md-6">
                    <button class="btn btn-outline-secondary w-100" disabled>
                        📚 Lihat Buku (Khusus Anggota)
                    </button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-outline-secondary w-100" disabled>
                        🔄 Peminjaman (Khusus Anggota)
                    </button>
                </div>
            </div>

        @else
            {{-- SUDAH ANGGOTA --}}
            <div class="alert alert-success text-center">
                🎉 Kamu sudah terdaftar sebagai anggota perpustakaan
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-4">
                    <div class="card border-0 bg-light h-100">
                        <div class="card-body text-center">
                            <h6 class="fw-bold">📚 Lihat Buku</h6>
                            <p class="text-muted small">
                                Jelajahi koleksi buku perpustakaan
                            </p>
                            <a href="/buku" class="btn btn-primary btn-sm">
                                Lihat Buku
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 bg-light h-100">
                        <div class="card-body text-center">
                            <h6 class="fw-bold">🔄 Peminjaman Aktif</h6>
                            <p class="text-muted small">
                                Buku yang sedang kamu pinjam
                            </p>
                            <a href="/list-pinjaman" class="btn btn-outline-primary btn-sm">
                                Lihat Peminjaman
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 bg-light h-100">
                        <div class="card-body text-center">
                            <h6 class="fw-bold">📜 Riwayat</h6>
                            <p class="text-muted small">
                                Riwayat peminjaman buku
                            </p>
                            <a href="/riwayat-peminjaman" class="btn btn-outline-secondary btn-sm">
                                Lihat Riwayat
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>


</div>
@endsection
