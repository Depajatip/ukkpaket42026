@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <strong>📖 Daftar Anggota Perpustakaan</strong>
                </div>

                <div class="card-body">
                    <form action="{{ auth()->user()->role == 'admin' ? route('admin.anggota.store') : route('anggota.store') }}" method="POST">
                        @csrf

                        {{-- Hidden Input untuk user_id --}}
                        {{-- Jika Admin yang mendaftarkan, pakai id dari $selectedUser. Jika murid daftar sendiri, pakai auth()->id() --}}
                        <input type="hidden" name="user_id" value="{{ isset($selectedUser) ? $selectedUser->id : auth()->id() }}">

                        {{-- NIS (readonly) --}}
                        <div class="mb-3">
                            <label class="form-label">NIS</label>
                            <input type="text" class="form-control bg-light"
                                   value="{{ isset($selectedUser) ? $selectedUser->nis : auth()->user()->nis }}" readonly>
                        </div>

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control bg-light"
                                   value="{{ isset($selectedUser) ? $selectedUser->nama_siswa : auth()->user()->nama_siswa }}" readonly>
                        </div>

                        {{-- Kelas --}}
                        <div class="mb-3">
                            <label class="form-label">Kelas</label>
                            <input type="text" class="form-control bg-light"
                                   value="{{ isset($selectedUser) ? $selectedUser->kelas : auth()->user()->kelas }}" readonly>
                        </div>

                        {{-- No Telp --}}
                        <div class="mb-3">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror" 
                                   placeholder="Contoh: 08123456789" required>
                            @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Alamat --}}
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" 
                                      rows="3" placeholder="Masukkan alamat lengkap..." required></textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                ✅ Konfirmasi Daftar Anggota
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-light text-muted">Batal</a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection