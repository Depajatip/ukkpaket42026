@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Dashboard User</h4>

    <p><b>NIS:</b> {{ auth()->user()->nis }}</p>
    <p><b>Nama:</b> {{ auth()->user()->nama_siswa }}</p>
    <p><b>Kelas:</b> {{ auth()->user()->kelas }}</p>

    <hr>

    @if(auth()->user()->anggota)
        <span class="badge bg-success">Anggota Aktif</span>
    @else
        <span class="badge bg-danger">Belum Terdaftar Anggota</span>
        <br><br>
        <a href="/daftar-anggota" class="btn btn-primary btn-sm">
            Daftar Anggota Perpustakaan
        </a>
    @endif
</div>
@endsection
