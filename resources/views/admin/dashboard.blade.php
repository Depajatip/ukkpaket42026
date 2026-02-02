@extends('layouts.admin')

@section('content')

<h4 class="fw-bold mb-4">📊 Dashboard Admin</h4>

<div class="row g-3">

    {{-- TOTAL BUKU --}}
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <small class="text-muted">Total Buku</small>
                <h3 class="fw-bold mt-2">120</h3>
            </div>
        </div>
    </div>

    {{-- TOTAL ANGGOTA --}}
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <small class="text-muted">Anggota Aktif</small>
                <h3 class="fw-bold mt-2">45</h3>
            </div>
        </div>
    </div>

    {{-- DIPINJAM --}}
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <small class="text-muted">Sedang Dipinjam</small>
                <h3 class="fw-bold mt-2">17</h3>
            </div>
        </div>
    </div>

    {{-- TERLAMBAT --}}
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <small class="text-muted">Terlambat</small>
                <h3 class="fw-bold mt-2 text-danger">3</h3>
            </div>
        </div>
    </div>

</div>

<hr class="my-4">

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h6 class="fw-bold mb-3">📌 Shortcut</h6>

        <a href="{{ route('admin.buku.create') }}"
           class="btn btn-primary me-2">
            ➕ Tambah Buku
        </a>

        <a href="{{ route('admin.buku.index') }}"
           class="btn btn-outline-secondary">
            📘 Kelola Buku
        </a>
    </div>
</div>

@endsection
