@extends('layouts.admin.admin')

@section('content')

<h4 class="fw-bold mb-3">✏️ Edit Buku</h4>

<div class="card shadow-sm border-0">
    <div class="card-body">
        {{-- Notifikasi Error/Sukses --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Periksa kembali:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form action="{{ route('admin.buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Judul Buku</label>
                <input type="text" name="judul_buku" value="{{ $buku->judul_buku }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Pengarang</label>
                <input type="text" name="pengarang" value="{{ $buku->pengarang }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Penerbit</label>
                <input type="text" name="penerbit" value="{{ $buku->penerbit }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tahun Terbit</label>
                <input type="number" name="tahun_terbit" value="{{ $buku->tahun_terbit }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" value="{{ $buku->stok }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Buku (Kosongkan jika tidak ingin ganti)</label>
                @if($buku->gambar)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$buku->gambar) }}" width="120" class="rounded border shadow-sm">
                    </div>
                @endif
                <input type="file" name="gambar" class="form-control">
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">💾 Update Data</button>
                <a href="{{ route('admin.buku.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>

    </div>
</div>

@endsection