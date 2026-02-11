@extends('layouts.admin')

@section('content')

<h4 class="fw-bold mb-3">📘 Manajemen Buku</h4>

<a href="{{ route('admin.buku.create') }}"
    class="btn btn-primary mb-3">
    ➕ Tambah Buku
</a>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Sampul</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($buku as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($item->gambar)
                        <img src="{{ asset('storage/'.$item->gambar) }}"
                            width="60"
                            class="rounded shadow-sm">
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ $item->judul_buku }}</td>
                    <td>{{ $item->pengarang }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>
                        <a href="{{ route('admin.buku.edit', $item) }}"
                            class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('admin.buku.destroy', $item) }}"
                            method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Hapus buku?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection