@extends('layouts.admin')

@section('content')
<div class="container my-4">
    <h4 class="fw-bold mb-4">📑 Manajemen Transaksi Buku</h4>

    <div class="card shadow-sm border-0">
        <div class="card-body table-responsive">
            <table class="table align-middle">
                <thead class="table-light">
                    <tr>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Status</th>
                        <th width="260">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksi as $t)
                    <tr>
                        <td>{{ $t->user->nis }}</td>
                        <td>{{ $t->user->nama_siswa }}</td>
                        <td>{{ $t->buku->judul_buku }}</td>
                        <td>{{ $t->tanggal_pinjam}}</td>

                        {{-- STATUS --}}
                        <td>
                            @switch($t->status)
                                @case('menunggu_pinjam')
                                    <span class="badge bg-warning text-dark">Menunggu ACC Pinjam</span>
                                    @break

                                @case('dipinjam')
                                    <span class="badge bg-primary">Dipinjam</span>
                                    @break

                                @case('menunggu_pengembalian')
                                    <span class="badge bg-info text-dark">Menunggu ACC Pengembalian</span>
                                    @break

                                @case('dikembalikan')
                                    <span class="badge bg-success">Dikembalikan</span>
                                    @break

                                @case('ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                    @break
                            @endswitch
                        </td>

                        {{-- AKSI --}}
                        <td>
                            {{-- ACC PINJAM --}}
                            @if($t->status === 'menunggu_pinjam')
                                <form action="{{ route('admin.transaksi.approve', $t) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-success btn-sm">
                                        ✔ ACC Pinjam
                                    </button>
                                </form>

                                <form action="{{ route('admin.transaksi.reject', $t) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">
                                        ✖ Tolak
                                    </button>
                                </form>
                            @endif

                            {{-- ACC PENGEMBALIAN --}}
                            @if($t->status === 'menunggu_pengembalian')
                                <form action="{{ route('admin.transaksi.return', $t) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-secondary btn-sm">
                                        ↩ ACC Pengembalian
                                    </button>
                                </form>
                            @endif

                            {{-- TIDAK ADA AKSI --}}
                            @if(in_array($t->status, ['dipinjam','dikembalikan','ditolak']))
                                <span class="text-muted fst-italic">—</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Belum ada transaksi
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
