@extends('layouts.app')

@section('content')

{{-- AOS CSS --}}
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<div class="katalog-wrapper py-5">

    <div class="container">

        {{-- HEADER --}}
        <div class="text-center mb-5" data-aos="fade-down">
            <h2 class="fw-bold katalog-title">
                📚 Koleksi Buku Perpustakaan
            </h2>
            <p class="text-light opacity-75">
                Temukan buku favoritmu dan nikmati pengalaman membaca terbaik
            </p>
        </div>

        {{-- GRID --}}
        <div class="row g-4">

            @forelse($buku as $item)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3"
                data-aos="zoom-in-up"
                data-aos-delay="{{ $loop->index * 100 }}">

                <div class="katalog-card h-100">

                    {{-- IMAGE --}}
                    <div class="katalog-img-wrapper">
                        <img src="{{ asset('storage/'.$item->gambar) }}"
                            alt="{{ $item->judul_buku }}"
                            class="katalog-img">

                        <div class="year-badge">
                            {{ $item->tahun_terbit }}
                        </div>
                    </div>

                    {{-- CONTENT --}}
                    <div class="katalog-body d-flex flex-column">

                        <h6 class="katalog-judul">
                            {{ $item->judul_buku }}
                        </h6>

                        <small class="text-light opacity-75">
                            Penulis: {{ $item->pengarang }}
                        </small>

                        <small class="text-light opacity-75 mb-3">
                            Penerbit: {{ $item->penerbit }}
                        </small>

                        <div class="mt-auto">

                            {{-- STOK --}}
                            @if($item->stok > 0)
                            <div class="stok-badge tersedia">
                                Stok: {{ $item->stok }}
                            </div>
                            @else
                            <div class="stok-badge habis">
                                Stok Habis
                            </div>
                            @endif

                            {{-- BUTTON --}}
                            @if(!auth()->user()->anggota)
                            <a href="/daftar-anggota"
                                class="btn btn-warning w-100 btn-action">
                                🔒 Daftar Sebagai Anggota
                            </a>
                            @else
                            <form action="{{ route('pinjam.store', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="btn btn-light w-100 btn-action"
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
            <div class="text-center text-light">
                Belum ada buku tersedia 📭
            </div>
            @endforelse

        </div>
    </div>
</div>

{{-- AOS JS --}}
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 900,
        once: true
    });
</script>

{{-- ================== CUSTOM STYLE ================== --}}
<style>

    /* Background Section */
    .katalog-wrapper {
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        min-height: 100vh;
    }

    .katalog-title {
        color: #fff;
        font-size: 2rem;
        letter-spacing: 1px;
    }

    /* CARD STYLE */
    .katalog-card {
        background: rgba(255,255,255,0.08);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        overflow: hidden;
        transition: all .4s ease;
        box-shadow: 0 10px 25px rgba(0,0,0,.25);
        border: 1px solid rgba(255,255,255,0.15);
    }

    .katalog-card:hover {
        transform: translateY(-10px) scale(1.03);
        box-shadow: 0 25px 50px rgba(0,0,0,.4);
    }

    /* IMAGE */
    .katalog-img-wrapper {
        position: relative;
        overflow: hidden;
    }

    .katalog-img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform .5s ease;
    }

    .katalog-card:hover .katalog-img {
        transform: scale(1.15) rotate(1deg);
    }

    /* YEAR BADGE */
    .year-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(0,0,0,0.7);
        padding: 6px 12px;
        border-radius: 30px;
        color: #fff;
        font-size: 12px;
        backdrop-filter: blur(5px);
        transform: translateY(-10px);
        opacity: 0;
        transition: all .3s ease;
    }

    .katalog-card:hover .year-badge {
        transform: translateY(0);
        opacity: 1;
    }

    /* BODY */
    .katalog-body {
        padding: 20px;
        color: white;
    }

    .katalog-judul {
        font-weight: 600;
        margin-bottom: 5px;
    }

    /* STOK */
    .stok-badge {
        padding: 6px 12px;
        border-radius: 30px;
        font-size: 12px;
        margin-bottom: 10px;
        display: inline-block;
    }

    .tersedia {
        background: rgba(0,255,150,.2);
        color: #00ffae;
    }

    .habis {
        background: rgba(255,0,0,.2);
        color: #ff5c5c;
    }

    /* BUTTON */
    .btn-action {
        border-radius: 30px;
        font-weight: 600;
        transition: all .3s ease;
    }

    .btn-action:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0,0,0,.3);
    }

    /* RESPONSIVE */
    @media(max-width:768px){
        .katalog-img {
            height: 200px;
        }
    }

</style>

@endsection