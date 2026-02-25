@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h3 class="fw-bold mb-4 text-center">
        📚 Peminjaman Aktif Saya
    </h3>

    {{-- Flash Message --}}
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif


    @if($transaksi->count() == 0)

    <div class="text-center py-5">
        <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png"
            width="120"
            class="mb-3">
        <h5 class="text-muted">Tidak ada buku yang sedang dipinjam</h5>
    </div>

    @else

<div class="row g-4">
    @foreach($transaksi as $t)

    <div class="col-md-6 col-lg-4">

        <div class="card border-0 shadow-sm h-100 book-card">

            {{-- Gambar --}}
            <div class="position-relative overflow-hidden rounded-top">
                <img src="{{ asset('storage/'.$t->buku->gambar) }}"
                    class="img-fluid w-100 book-image">

                {{-- Badge Status --}}
                @if($t->status == 'menunggu_pinjam')
                    <span class="badge bg-warning position-absolute top-0 end-0 m-2">
                        ⏳ Menunggu ACC
                    </span>
                @elseif($t->status == 'dipinjam')
                    <span class="badge bg-primary position-absolute top-0 end-0 m-2">
                        📖 Sedang Dipinjam
                    </span>
                @elseif($t->status == 'menunggu_pengembalian')
                    <span class="badge bg-info position-absolute top-0 end-0 m-2">
                        🔄 Menunggu Pengembalian
                    </span>
                @endif
            </div>

            {{-- Body --}}
            <div class="card-body d-flex flex-column">

                <h5 class="fw-bold">
                    {{ $t->buku->judul_buku }}
                </h5>

                <small class="text-muted mb-1">
                    Penulis: {{ $t->buku->pengarang }}
                </small>

                <small class="text-muted mb-1">
                    Penerbit: {{ $t->buku->penerbit }}
                </small>

                <small class="text-muted mb-1">
                    Tahun Terbit: {{ $t->buku->tahun_terbit }}
                </small>

                <small class="text-muted mb-3">
                    Tanggal Pinjam: {{ \Carbon\Carbon::parse($t->tanggal_pinjam)->format('d M Y') }}
                </small>

                {{-- Tombol --}}
                <div class="mt-auto pt-3">

                    @if($t->status == 'dipinjam')
                        <form action="{{ route('pengembalian.ajukan',$t->id) }}"
                            method="POST">
                            @csrf
                            <button class="btn btn-outline-dark w-100 return-btn">
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

<style>
    .book-card {
        transition: all .3s ease;
        border-radius: 16px;
    }

    .book-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .book-image {
        height: 220px;
        object-fit: cover;
        transition: transform .4s ease;
    }

    .book-card:hover .book-image {
        transform: scale(1.08);
    }

    .return-btn {
        transition: all .3s ease;
    }

    .return-btn:hover {
        background: #212529;
        color: white;
    }
</style>
@endsection