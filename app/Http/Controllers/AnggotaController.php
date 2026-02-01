<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function create()
    {
        // cegah user daftar dua kali
        if (auth()->user()->anggota) {
            return redirect('/dashboard');
        }

        return view('anggota.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'no_telp' => 'required',
        'alamat'  => 'required',
    ]);

    // Cegah daftar 2x
    if (auth()->user()->anggota) {
        return redirect()->back()->with('error', 'Anda sudah terdaftar.');
    }

    Anggota::create([
        'nis'            => auth()->user()->nis,
        'no_telp'        => $request->no_telp,
        'alamat'         => $request->alamat,
        'tanggal_daftar' => now(),
        'status_anggota' => 'aktif'
    ]);

    return redirect('/dashboard')->with('success', 'Berhasil mendaftar anggota.');
}

}

