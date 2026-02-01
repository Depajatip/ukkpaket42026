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
                    <form action="{{ route('anggota.store') }}" method="POST">
                        @csrf

                        {{-- NIS (readonly) --}}
                        <div class="mb-3">
                            <label class="form-label">NIS</label>
                            <input type="text" class="form-control"
                                   value="{{ auth()->user()->nis }}" readonly>
                        </div>

                        {{-- Nama --}}
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control"
                                   value="{{ auth()->user()->nama_siswa }}" readonly>
                        </div>

                        {{-- Kelas --}}
                        <div class="mb-3">
                            <label class="form-label">Kelas</label>
                            <input type="text" class="form-control"
                                   value="{{ auth()->user()->kelas }}" readonly>
                        </div>

                        {{-- No Telp --}}
                        <div class="mb-3">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" name="no_telp"
                                   class="form-control" required>
                        </div>

                        {{-- Alamat --}}
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary">
                                ✅ Daftar Anggota
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
