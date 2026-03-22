@extends('layouts.admin.admin')

@section('content')

<h4 class="fw-bold mb-3">Manajemen Murid</h4>

<button class="btn btn-success rounded-pill px-4 shadow-sm mb-3"
    data-bs-toggle="modal"
    data-bs-target="#modalTambahMurid">
    <i class="fas fa-plus me-2"></i> Tambah Murid
</button>

<form action="{{ route('admin.managemurid.index') }}" method="GET" class="d-flex mb-3">
    <input type="text" name="search" class="form-control me-2"
        placeholder="Cari..." value="{{ request('search') }}">
    <button type="submit" class="btn btn-secondary">Cari</button>
</form>

<div class="card shadow-sm border-0 mt-3">
    <div class="card-body">

        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Status Anggota</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach($listMurid as $murid)

                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $murid->nis }}</td>
                    <td>{{ $murid->nama_siswa }}</td>
                    <td>{{ $murid->kelas }}</td>

                    <td>
                        <span class="badge {{ ($murid->anggota && $murid->anggota->status_anggota == 'aktif') ? 'bg-success' : 'bg-secondary' }}">
                            {{ ($murid->anggota && $murid->anggota->status_anggota == 'aktif') ? 'AKTIF' : 'TIDAK AKTIF' }}
                        </span>
                    </td>

                    <td>
                        <button class="btn btn-sm btn-warning"
                            data-bs-toggle="modal"
                            data-bs-target="#editMurid{{ $murid->id }}">
                            Edit
                        </button>

                        <form action="{{ route('admin.murid.destroy', $murid->id) }}"
                            method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Apakah Anda yakin?')">
                                Hapus
                            </button>
                        </form>

                        @if(!($murid->anggota && $murid->anggota->status_anggota == 'aktif'))
                        <a href="{{ route('admin.anggota.create', ['id' => $murid->id]) }}"
                            class="btn btn-sm btn-success">
                            <i class="fas fa-user-plus"></i> Jadikan Anggota
                        </a>
                        @endif
                    </td>

                </tr>

                @endforeach

            </tbody>
        </table>

    </div>
</div>

@foreach($listMurid as $murid)

<div class="modal fade" id="editMurid{{ $murid->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Murid</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('admin.murid.update', $murid->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="mb-3">
                        <label>NIS</label>
                        <input type="text"
                            name="nis"
                            class="form-control"
                            value="{{ $murid->nis }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label>Nama</label>
                        <input type="text"
                            name="nama_siswa"
                            class="form-control"
                            value="{{ $murid->nama_siswa }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label>Kelas</label>
                        <input type="text"
                            name="kelas"
                            class="form-control"
                            value="{{ $murid->kelas }}"
                            required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endforeach


<div class="modal fade" id="modalTambahMurid" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form action="{{ route('admin.murid.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Murid</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>NIS</label>
                            <input type="text"
                                name="nis"
                                class="form-control @error('nis') is-invalid @enderror"
                                value="{{ old('nis') }}"
                                required>

                            @error('nis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Nama Siswa</label>
                            <input type="text"
                                name="nama_siswa"
                                class="form-control @error('nama_siswa') is-invalid @enderror"
                                value="{{ old('nama_siswa') }}"
                                required>

                            @error('nama_siswa')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Kelas</label>
                            <input type="text"
                                name="kelas"
                                class="form-control"
                                required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Password</label>
                            <input type="password"
                                name="password"
                                class="form-control"
                                required>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button class="btn btn-success">
                        Simpan Murid
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@if ($errors->any())
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var modal = new bootstrap.Modal(document.getElementById('modalTambahMurid'));
        modal.show();
    });
</script>
@endif

@endsection