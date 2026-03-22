@foreach($history as $t)

            <div class="col-12 col-sm-6 col-lg-4 buku-item">

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