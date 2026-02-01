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
                <div class="alert alert-warning">
                    📌 Kamu belum terdaftar sebagai anggota perpustakaan.
                </div>

                <div class="text-center">
                    <a href="/daftar-anggota" class="btn btn-primary px-4">
                        📖 Daftar Anggota
                    </a>
                </div>
            @else
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card border-0 bg-light h-100">
                            <div class="card-body">
                                <h6 class="fw-bold">📚 Peminjaman Aktif</h6>
                                <p class="mb-2 text-muted">
                                    Lihat buku yang sedang kamu pinjam
                                </p>
                                <a href="/peminjaman" class="btn btn-outline-primary btn-sm">
                                    Lihat Peminjaman
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card border-0 bg-light h-100">
                            <div class="card-body">
                                <h6 class="fw-bold">📜 Riwayat</h6>
                                <p class="mb-2 text-muted">
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
