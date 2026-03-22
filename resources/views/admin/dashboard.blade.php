@extends('layouts.admin.admin')

@section('content')
<style>
    .stat-card {
        border-radius: 15px;
        border: none;
    }

    .icon-box {
        width: 45px;
        height: 45px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .scroll-area {
        max-height: 380px;
        overflow-y: auto;
    }

    .avatar-circle {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        color: white;
        font-size: 0.8rem;
    }

    .populer-item {
        border-left: 3px solid #4e73df;
        background: #f8f9fc;
        padding: 8px 12px;
        border-radius: 5px;
    }
</style>

<div class="container-fluid py-4">
    <div class="row g-3 mb-4">
        @php
        $stats = [
        ['Total Buku', $totalBuku, 'fa-book', 'bg-primary'],
        ['Anggota', $totalAnggota, 'fa-users', 'bg-success'],
        ['Peminjaman', $totalTransaksi, 'fa-exchange-alt', 'bg-warning text-dark'],
        ['Menunggu ACC', $jumlahMenunggu, 'fa-clock', 'bg-danger']
        ];
        @endphp
        @foreach($stats as $s)
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card stat-card shadow-sm p-3">
                <div class="d-flex align-items-center">
                    <div class="icon-box {{ $s[3] }} text-white"><i class="fas {{ $s[2] }}"></i></div>
                    <div class="ms-3">
                        <small class="text-muted d-block">{{ $s[0] }}</small>
                        <h4 class="fw-bold mb-0">{{ $s[1] }}</h4>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Statistik Peminjaman</h5>
                    <form action="{{ route('admin.dashboard') }}" method="GET" id="filterForm">
                        <select name="filter" class="form-select form-select-sm" onchange="document.getElementById('filterForm').submit()">
                            <option value="mingguan" {{ $filter == 'mingguan' ? 'selected' : '' }}>7 Hari Terakhir</option>
                            <option value="bulanan" {{ $filter == 'bulanan' ? 'selected' : '' }}>6 Bulan Terakhir</option>
                        </select>
                    </form>
                </div>
                <div style="height: 300px;"><canvas id="canvasUtama"></canvas></div>
            </div>

            <div class="card border-0 shadow-sm p-4">
                <h5 class="fw-bold mb-4">History Transaksi Terbaru</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr style="font-size: 0.8rem;">
                                <th>Siswa</th>
                                <th>Buku</th>
                                <th>Status</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 0.82rem;">
                            @foreach($aktivitasTransaksi as $at)
                            <tr>
                                <td><strong>{{ $at->anggota->user->nama_siswa ?? 'N/A' }}</strong></td>
                                <td>{{ Str::limit($at->buku->judul_buku ?? 'N/A', 25) }}</td>
                                <td><span class="badge {{ $at->status == 'dikembalikan' ? 'bg-success' : ($at->status == 'ditolak' ? 'bg-danger' : 'bg-primary') }} bg-opacity-10 text-{{ $at->status == 'dikembalikan' ? 'success' : ($at->status == 'ditolak' ? 'danger' : 'primary') }}">{{ str_replace('_', ' ', $at->status) }}</span></td>
                                <td class="text-muted small">{{ $at->updated_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm p-4 mb-4">
                <h5 class="fw-bold mb-4">Anggota Baru</h5>
                <div class="scroll-area">
                    @foreach($anggotaBaru as $ab)
                    <div class="d-flex align-items-center mb-3">
                        <div class="avatar-circle bg-primary bg-opacity-10 text-primary">{{ strtoupper(substr($ab->user->nama_siswa, 0, 1)) }}</div>
                        <div class="ms-3">
                            <h6 class="mb-0 fw-bold small">{{ $ab->user->nama_siswa }}</h6>
                            <small class="text-muted" style="font-size: 0.7rem;">NIS: {{ $ab->user->nis ?? '-' }} • {{ $ab->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="card border-0 shadow-sm p-4 d-flex flex-column" style="min-height: 480px;">
                <h5 class="fw-bold mb-3">Ringkasan Status</h5>

                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-1 small">
                        <span>Buku Dikembalikan</span>
                        <span class="fw-bold text-success">{{ $persenKembali }}%</span>
                    </div>
                    <div class="progress" style="height: 10px; border-radius: 10px;">
                        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"
                            role="progressbar"
                            style="width: {{ $persenKembali }}%">
                        </div>
                    </div>
                </div>

                <div class="flex-grow-1">
                    <h6 class="fw-bold small mb-3">
                        <i class="fas fa-fire text-danger me-2"></i>Buku Paling Sering Dipinjam
                    </h6>

                    @forelse($bukuPopuler as $bp)
                    <div class="populer-item mb-3 shadow-sm border-0" style="background: #f8f9fc; padding: 12px; border-radius: 10px;">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="badge bg-primary me-2">{{ $loop->iteration }}</div>
                                <span class="small fw-bold text-dark">{{ Str::limit($bp->buku->judul_buku ?? 'Buku', 25) }}</span>
                            </div>
                            <span class="badge bg-white text-primary border">{{ $bp->total }}x</span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4">
                        <small class="text-muted">Belum ada data populer</small>
                    </div>
                    @endforelse
                </div>

                <div class="mt-auto">
                    <hr class="my-3">
                    <a href="{{ route('admin.historytransaksi') }}" class="btn btn-primary btn-sm w-100 py-2 shadow-sm">
                        <i class="fas fa-list me-2"></i>Buka Riwayat Lengkap
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script>
    setTimeout(function() {
        const ctx = document.getElementById('canvasUtama').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Peminjaman',
                    data: @json($chartData),
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.1)',
                    borderWidth: 3,
                    pointRadius: 4,
                    lineTension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }]
                }
            }
        });
    }, 500);
</script>
@endsection