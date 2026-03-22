@extends('layouts.admin.admin')

@section('content')
<style>
    nav .flex.justify-between.flex-1.sm\:hidden {
        display: none;
    }

    nav .grid.grid-cols-1 {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .pagination {
        margin-bottom: 0;
    }

    .badge {
        padding: 0.5em 0.9em;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.75rem;
    }

    .table thead th {
        background-color: #f8f9fa;
        text-transform: capitalize;
        font-weight: 700;
        border-bottom: 1px solid #dee2e6;
    }

    .card {
        border-radius: 12px;
        overflow: hidden;
    }

    thead th a:hover {
        color: #007bff !important;
    }

    thead th i {
        font-size: 0.8rem;
        color: #ccc;
    }

    thead th .fa-sort-up,
    thead th .fa-sort-down {
        color: #007bff;
    }
</style>


    <h4 class="fw-bold mb-4">📑 History Transaksi</h4>

    <div class="d-flex justify-content-between mb-4">
        <form action="{{ route('admin.historytransaksi') }}" method="GET" class="d-flex flex-grow-1 me-2">
            <input type="text" name="search" class="form-control me-2"
                placeholder="Cari ID, NIS, Nama, atau Buku..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary px-4">Cari</button>

            @if(request('search'))
            <a href="{{ route('admin.historytransaksi') }}" class="btn btn-outline-danger ms-2">Reset</a>
            @endif
        </form>

        @if(request('sort') || request('order'))
        <a href="{{ route('admin.historytransaksi', ['search' => request('search')]) }}"
            class="btn btn-outline-primary" title="Restart Sort">
            <i class="fas fa-sync-alt"></i> Restart Sort
        </a>
        @endif
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-3">
                                <a href="{{ route('admin.historytransaksi', array_merge(request()->query(), ['sort' => 'id', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}" class="text-dark text-decoration-none">
                                    ID <i class="fas fa-sort{{ request('sort') == 'id' ? (request('order') == 'asc' ? '-up' : '-down') : '' }} ms-1"></i>
                                </a>
                            </th>

                            <th>
                                <a href="{{ route('admin.historytransaksi', array_merge(request()->query(), ['sort' => 'nis', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}" class="text-dark text-decoration-none">
                                    NIS <i class="fas fa-sort{{ request('sort') == 'nis' ? (request('order') == 'asc' ? '-up' : '-down') : '' }} ms-1"></i>
                                </a>
                            </th>

                            <th>
                                <a href="{{ route('admin.historytransaksi', array_merge(request()->query(), ['sort' => 'nama', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}" class="text-dark text-decoration-none">
                                    Nama <i class="fas fa-sort{{ request('sort') == 'nama' ? (request('order') == 'asc' ? '-up' : '-down') : '' }} ms-1"></i>
                                </a>
                            </th>

                            <th>
                                <a href="{{ route('admin.historytransaksi', array_merge(request()->query(), ['sort' => 'buku', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}" class="text-dark text-decoration-none">
                                    Buku <i class="fas fa-sort{{ request('sort') == 'buku' ? (request('order') == 'asc' ? '-up' : '-down') : '' }} ms-1"></i>
                                </a>
                            </th>

                            <th>
                                <a href="{{ route('admin.historytransaksi', array_merge(request()->query(), ['sort' => 'tanggal_pinjam', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}" class="text-dark text-decoration-none">
                                    Pinjam <i class="fas fa-sort{{ request('sort') == 'tanggal_pinjam' ? (request('order') == 'asc' ? '-up' : '-down') : '' }} ms-1"></i>
                                </a>
                            </th>

                            <th>
                                <a href="{{ route('admin.historytransaksi', array_merge(request()->query(), ['sort' => 'tanggal_kembali', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}" class="text-dark text-decoration-none">
                                    Kembali <i class="fas fa-sort{{ request('sort') == 'tanggal_kembali' ? (request('order') == 'asc' ? '-up' : '-down') : '' }} ms-1"></i>
                                </a>
                            </th>

                            <th class="pe-3">
                                <a href="{{ route('admin.historytransaksi', array_merge(request()->query(), ['sort' => 'status', 'order' => request('order') == 'asc' ? 'desc' : 'asc'])) }}" class="text-dark text-decoration-none">
                                    Status <i class="fas fa-sort{{ request('sort') == 'status' ? (request('order') == 'asc' ? '-up' : '-down') : '' }} ms-1"></i>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($historytransaksi as $t)
                        <tr>
                            <td class="ps-3 font-monospace text-primary fw-bold">#{{ $t->id }}</td>
                            <td>{{ $t->anggota->user->nis ?? '-' }}</td>
                            <td><strong>{{ $t->anggota->user->nama_siswa ?? 'Data Terhapus' }}</strong></td>
                            <td>{{ $t->buku->judul_buku ?? 'Buku Terhapus' }}</td>
                            <td>{{ \Carbon\Carbon::parse($t->tanggal_pinjam)->format('d/m/Y') }}</td>
                            <td>{{ $t->tanggal_kembali ? \Carbon\Carbon::parse($t->tanggal_kembali)->format('d/m/Y') : '-' }}</td>
                            <td class="pe-3">
                                @if($t->status == 'dikembalikan')
                                <span class="badge bg-success text-white">
                                    <i class="fas fa-check-circle me-1"></i> Dikembalikan
                                </span>
                                @elseif($t->status == 'ditolak')
                                <span class="badge bg-danger text-white">
                                    <i class="fas fa-times-circle me-1"></i> Ditolak
                                </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                Tidak ada riwayat transaksi.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4 px-2">
        {{ $historytransaksi->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>

@endsection