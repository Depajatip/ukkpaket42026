@extends('layouts.app')

@section('content')

{{-- AOS CSS --}}
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<div class="peminjaman-wrapper py-5">

    <div class="container">

        {{-- HEADER --}}
        <div class="text-center mb-5" data-aos="fade-down">
            <h2 class="fw-bold text-white">
                📚 Peminjaman Aktif Saya
            </h2>
            <p class="text-light opacity-75">
                Pantau status peminjaman buku Anda secara real-time
            </p>
        </div>

        @if($transaksi->count() == 0)

        <div class="text-center py-5" data-aos="zoom-in">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png"
                width="130"
                class="mb-4 floating">
            <h5 class="text-light opacity-75">
                Tidak ada buku yang sedang dipinjam
            </h5>
        </div>

        @else

        <div class="row g-4">
            @foreach($transaksi as $t)

            <div class="col-12 col-sm-6 col-lg-4"
                data-aos="fade-up"
                data-aos-delay="{{ $loop->index * 100 }}">

                <div class="pinjam-card h-100">

                    {{-- IMAGE --}}
                    <div class="pinjam-img-wrapper">

                        <img src="{{ asset('storage/'.$t->buku->gambar) }}"
                            class="pinjam-img">

                        {{-- STATUS BADGE --}}
                        @if($t->status == 'menunggu_pinjam')
                        <div class="status-badge waiting">
                            ⏳ Menunggu ACC
                        </div>
                        @elseif($t->status == 'dipinjam')
                        <div class="status-badge active">
                            📖 Sedang Dipinjam
                        </div>
                        @elseif($t->status == 'menunggu_pengembalian')
                        <div class="status-badge returning">
                            🔄 Menunggu Pengembalian
                        </div>
                        @endif

                    </div>

                    {{-- BODY --}}
                    <div class="pinjam-body d-flex flex-column">

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

                        <small class="text-light opacity-75 mb-3">
                            Tanggal Peminjaman: {{ \Carbon\Carbon::parse($t->tanggal_pinjam)->format('d M Y') }}
                        </small>

                        {{-- BUTTON --}}
                        <div class="mt-auto">

                            @if($t->status == 'dipinjam')
                            <form action="{{ route('pengembalian.ajukan',$t->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-light w-100 btn-action">
                                    Ajukan Pengembalian
                                </button>
                            </form>

                            @elseif($t->status == 'menunggu_pinjam')
                            <button class="btn btn-warning w-100 text-dark" disabled>
                                Menunggu Persetujuan Peminjaman
                            </button>

                            @elseif($t->status == 'menunggu_pengembalian')
                            <button class="btn btn-info w-100 text-dark" disabled>
                                Menunggu Persetujuan Pengembalian
                            </button>
                            @endif

                        </div>

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
.peminjaman-wrapper {
    min-height: 100vh;
    background: linear-gradient(135deg, #141e30, #243b55);
}

/* CARD */
.pinjam-card {
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    overflow: hidden;
    transition: all .4s ease;
    box-shadow: 0 10px 25px rgba(0,0,0,.3);
    border: 1px solid rgba(255,255,255,0.15);
}

.pinjam-card:hover {
    transform: translateY(-12px) scale(1.03);
    box-shadow: 0 30px 60px rgba(0,0,0,.45);
}

/* IMAGE */
.pinjam-img-wrapper {
    position: relative;
    overflow: hidden;
}

.pinjam-img {
    width: 100%;
    height: 240px;
    object-fit: cover;
    transition: transform .5s ease;
}

.pinjam-card:hover .pinjam-img {
    transform: scale(1.12) rotate(1deg);
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

.waiting {
    background: rgba(255,193,7,.8);
}

.active {
    background: rgba(13,110,253,.85);
}

.returning {
    background: rgba(0,200,255,.85);
}

/* BODY */
.pinjam-body {
    padding: 20px;
}

/* BUTTON */
.btn-action {
    border-radius: 30px;
    font-weight: 600;
    transition: all .3s ease;
}

.btn-action:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 25px rgba(255,255,255,.25);
}

/* EMPTY FLOATING */
.floating {
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0px); }
}

/* RESPONSIVE */
@media(max-width:768px){
    .pinjam-img {
        height: 200px;
    }
}

</style>

@endsection