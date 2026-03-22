@foreach($transaksi as $t)

<div class="col-12 col-sm-6 col-lg-4 buku-item">

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
            <div class="status-badge dipinjam">
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
                Tahun Terbit: {{ $t->buku->tahun_terbit }}
            </small>

            <small class="text-light opacity-75 mb-3">
                Tanggal Peminjaman: {{ \Carbon\Carbon::parse($t->tanggal_pinjam)->format('d M Y') }}
            </small>
                                    <small class="text-light opacity-50">
                            ID Transaksi: #{{ $t->id }}
                        </small>

            {{-- BUTTON --}}
            <div class="flex justify-center items-center">

                @if($t->status == 'dipinjam')
                <form action="{{ route('pengembalian.ajukan',$t->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-light w-100">
                        <p class="m-0" style="font-size: 14px;">Ajukan pengembalian buku</p>
                    </button>
                </form>

                @elseif($t->status == 'menunggu_pinjam')
                <button class="btn btn-warning w-100 text-dark" disabled>
                    <p style="font-size: 14px; font-weight: bold;" class="m-0 text-center">Menunggu persetujuan</p>
                </button>

                @elseif($t->status == 'menunggu_pengembalian')
                <button class="btn btn-info w-100 text-dark" disabled>
                    <p style="font-size: 14px;" class="m-0 text-center">Menunggu persetujuan</p>
                </button>
                @endif

            </div>

        </div>
    </div>
</div>

@endforeach