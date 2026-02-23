@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h3 class="fw-bold mb-4 text-center">
        📖 History Peminjaman
    </h3>

    @if($history->count() == 0)

    <div class="text-center py-5">
        <img src="https://cdn-icons-png.flaticon.com/512/4076/4076507.png"
            width="120"
            class="mb-3">
        <h5 class="text-muted">Belum ada riwayat transaksi</h5>
    </div>

    @else

    <div class="row g-4">
        @foreach($history as $t)

        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100 history-card">

                <div class="position-relative overflow-hidden rounded-top">
                    <img src="{{ asset('storage/'.$t->buku->gambar) }}"
                        class="img-fluid w-100 book-image">
                {{-- Badge Status --}}
                @if($t->status == 'dikembalikan')
                    <span class="badge bg-warning position-absolute top-0 end-0 m-2">
                        Sudah dikembalikan
                    </span>
                @elseif($t->status == 'ditolak')
                    <span class="badge bg-info position-absolute top-0 end-0 m-2">
                        Ditolak
                    </span>
                @endif
                </div>

                <div class="card-body d-flex flex-column">

                    <h5 class="fw-bold">
                        {{ $t->buku->judul_buku }}
                    </h5>

                    <small class="text-muted mb-2">
                        Penulis: {{ $t->buku->penulis }}
                    </small>
                </div>
            </div>
        </div>

        @endforeach
    </div>

    @endif

</div>

<style>
    .history-card {
        transition: all .3s ease;
        border-radius: 16px;
    }

    .history-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .book-image {
        height: 220px;
        object-fit: cover;
        transition: transform .4s ease;
    }

    .history-card:hover .book-image {
        transform: scale(1.05);
    }
</style>
@endsection