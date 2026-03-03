@extends('layouts.app')

@section('content')

{{-- AOS CSS --}}
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<div class="history-wrapper py-5">

    <div class="container">

        {{-- HEADER --}}
        <div class="text-center mb-5" data-aos="fade-down">
            <h2 class="fw-bold text-white">
                📖 History Peminjaman
            </h2>
            <p class="text-light opacity-75">
                Riwayat seluruh transaksi peminjaman Anda
            </p>
        </div>

        @if($history->count() == 0)

        <div class="text-center py-5" data-aos="zoom-in">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076507.png"
                width="130"
                class="mb-4 floating">
            <h5 class="text-light opacity-75">
                Belum ada riwayat transaksi
            </h5>
        </div>

        @else

        <div class="row g-4">

            @foreach($history as $t)

            <div class="col-12 col-sm-6 col-lg-4"
                data-aos="fade-up"
                data-aos-delay="{{ $loop->index * 100 }}">

                <div class="history-card h-100">

                    {{-- IMAGE --}}
                    <div class="history-img-wrapper">
                        <img src="{{ asset('storage/'.$t->buku->gambar) }}"
                            class="history-img">

                        {{-- STATUS BADGE --}}
                        @if($t->status == 'dikembalikan')
                        <div class="status-badge returned">
                            ✅ Sudah Dikembalikan
                        </div>
                        @elseif($t->status == 'ditolak')
                        <div class="status-badge rejected">
                            ❌ Ditolak
                        </div>
                        @endif
                    </div>

                    {{-- BODY --}}
                    <div class="history-body d-flex flex-column">

                        <h5 class="fw-bold text-white">
                            {{ $t->buku->judul_buku }}
                        </h5>

                        <small class="text-light opacity-75">
                            Penulis: {{ $t->buku->pengarang }}
                        </small>

                        <small class="text-light opacity-75">
                            Penerbit: {{ $t->buku->penerbit }}
                        </small>

                        <small class="text-light opacity-75">
                            Tahun Terbit {{ $t->buku->tahun_terbit }}
                        </small>

                        <small class="text-light opacity-75">
                            Tanggal Peminjaman: {{ \Carbon\Carbon::parse($t->tanggal_pinjam)->format('d M Y') }}
                        </small>
                        <small class="text-light opacity-75 mb-3">
                            Tanggal Kembali: {{ \Carbon\Carbon::parse($t->tanggal_kembali)->format('d M Y') }}
                        </small>
                        <small class="text-light opacity-50">
                            ID Transaksi: #{{ $t->id }}
                        </small>

                    </div>
                </div>

            </div>

            @endforeach

        </div>

        @endif

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

<style>
    /* BACKGROUND */
    .history-wrapper {
        min-height: 100vh;
        background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    }

    /* CARD */
    .history-card {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        overflow: hidden;
        transition: all .4s ease;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .3);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }

    .history-card:hover {
        transform: translateY(-10px) scale(1.03);
        box-shadow: 0 30px 60px rgba(0, 0, 0, .45);
    }

    /* IMAGE */
    .history-img-wrapper {
        position: relative;
        overflow: hidden;
    }

    .history-img {
        width: 100%;
        height: 240px;
        object-fit: cover;
        transition: transform .5s ease;
    }

    .history-card:hover .history-img {
        transform: scale(1.12);
    }

    /* STATUS BADGE */
    .status-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 12px;
        backdrop-filter: blur(5px);
        color: white;
    }

    .returned {
        background: rgba(40, 167, 69, .85);
    }

    .rejected {
        background: rgba(220, 53, 69, .85);
    }

    /* BODY */
    .history-body {
        padding: 20px;
    }

    /* FLOATING ANIMATION */
    .floating {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    /* RESPONSIVE */
    @media(max-width:768px) {
        .history-img {
            height: 200px;
        }
    }
</style>

@endsection