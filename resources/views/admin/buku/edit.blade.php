@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">✏️ Edit Buku</h4>

    <form action="{{ route('admin.buku.update', $buku->id) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input name="judul_buku" value="{{ $buku->judul_buku }}" class="form-control mb-2">
        <input name="pengarang" value="{{ $buku->pengarang }}" class="form-control mb-2">
        <input name="penerbit" value="{{ $buku->penerbit }}" class="form-control mb-2">
        <input name="tahun_terbit" value="{{ $buku->tahun_terbit }}" class="form-control mb-2">
        <input name="stok" value="{{ $buku->stok }}" class="form-control mb-2">

        @if($buku->gambar)
            <img src="{{ asset('storage/'.$buku->gambar) }}"
                 width="120"
                 class="rounded mb-2">
        @endif

        <input type="file" name="gambar" class="form-control mb-3">

        <button class="btn btn-primary">💾 Update</button>
        <a href="{{ route('admin.buku.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>
@endsection
