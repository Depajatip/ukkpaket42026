@extends('layouts.app')

@section('content')
<div class="container my-4">

    {{-- Header --}}
    <div class="mb-4 text-center">
        <h4 class="fw-bold">📚 Koleksi Buku Perpustakaan</h4>
        <p class="text-muted">Pilih buku favoritmu dan ajukan peminjaman</p>
    </div>

    {{-- Grid Buku --}}
    <div class="row g-4">

        @forelse($buku as $item)
        <div class="col-md-3">
            <div class="card buku-card h-100 border-0 shadow-sm">

                {{-- Gambar --}}
                <div class="position-relative overflow-hidden">
                    <img
                        src="{{ asset('storage/'.$item->gambar) }}"
                        width="60"
                        class="card-img-top buku-img"
                        alt="{{ $item->judul_buku }}">

                    {{-- Overlay hover --}}
                    <div class="buku-overlay">
                        <span class="badge bg-dark">
                            {{ $item->tahun_terbit }}
                        </span>
                    </div>
                </div>

                {{-- Body --}}
                <div class="card-body d-flex flex-column">
                    <h6 class="fw-semibold mb-1">
                        {{ $item->judul_buku }}
                    </h6>

                    <small class="text-muted mb-1">
                        {{ $item->pengarang }}
                    </small>

                    <small class="text-muted mb-2">
                        {{ $item->penerbit }}
                    </small>

                    <div class="mt-auto">
                        {{-- Stok --}}
                        @if($item->stok > 0)
                        <span class="badge bg-success mb-2">
                            Stok: {{ $item->stok }}
                        </span>
                        @else
                        <span class="badge bg-danger mb-2">
                            Stok Habis
                        </span>
                        @endif

                        {{-- Tombol --}}
                        @if(!auth()->user()->anggota)
                        <a href="/daftar-anggota"
                            class="btn btn-outline-warning btn-sm w-100">
                            🔒 Daftar Anggota
                        </a>
                        @else
                        <!-- <button class="btn btn-primary btn-sm w-100"
                            {{ $item->stok == 0 ? 'disabled' : '' }}>
                            📥 Pinjam Buku
                        </button> -->

                        <form action="{{ route('pinjam.store', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="btn btn-primary btn-sm w-100"
                                {{ $item->stok == 0 ? 'disabled' : '' }}>
                                Pinjam Buku
                            </button>
                        </form>

                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center text-muted">
            Belum ada buku tersedia 📭
        </div>
        @endforelse

    </div>
</div>

{{-- CSS Khusus --}}
<style>
    .buku-card {
        transition: all .35s ease;
        border-radius: 16px;
    }

    .buku-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 18px 35px rgba(0, 0, 0, .15);
    }

    .buku-img {
        height: 230px;
        object-fit: cover;
        transition: transform .4s ease;
    }

    .buku-card:hover .buku-img {
        transform: scale(1.1);
    }

    .buku-overlay {
        position: absolute;
        top: 12px;
        right: 12px;
        opacity: 0;
        transition: opacity .3s ease;
    }

    .buku-card:hover .buku-overlay {
        opacity: 1;
    }
</style>
@endsection