@extends('layouts.app')

@section('content')

<div class="container my-4">
    <div class="mb-4 text-center">
        <h4 class="fw-bold">Daftar buku yang sedang kamu pinjam</h4>
        <p class="text-muted">blablabal</p>
    </div>
</div>

{{-- Grid Buku --}}
    <div class="row g-4">

        @forelse($transaksi as $pinjaman)
        <div class="col-md-3">
            <div class="card buku-card h-100 border-0 shadow-sm">

                {{-- Gambar --}}
                <div class="position-relative overflow-hidden">
                    <img
                        src="{{ asset('storage/'.$pinjaman->gambar) }}"
                        width="60"
                        class="card-img-top buku-img"
                        alt="{{ $pinjaman->judul_buku }}">

                    {{-- Overlay hover --}}
                    <div class="buku-overlay">
                        <span class="badge bg-dark">
                            {{ $pinjaman->tahun_terbit }}
                        </span>
                    </div>
                </div>

                {{-- Body --}}
                <div class="card-body d-flex flex-column">
                    <h6 class="fw-semibold mb-1">
                        {{ $pinjaman->status }}
                    </h6>

                    <small class="text-muted mb-2">
                        {{ $pinjaman->penerbit }}
                    </small>

                    <div class="mt-auto">

                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center text-muted">
            Belum ada buku yang dipinjam 📭
        </div>
        @endforelse

    </div>

@endsection