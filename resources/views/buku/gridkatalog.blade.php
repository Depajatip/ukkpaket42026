@forelse($buku as $item)

<div class="col-12 col-md-6 col-lg-4 buku-item">

    <div class="katalog-card h-100">

        <div class="katalog-img-wrapper">
            <img src="{{ asset('storage/'.$item->gambar) }}"
                class="katalog-img">

            <div class="year-badge">
                {{ $item->tahun_terbit }}
            </div>
        </div>

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

<div class="text-center mt-5">
    <h5>Buku tidak ditemukan 📚</h5>
</div>

@endforelse