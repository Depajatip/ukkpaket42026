<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Transaksi;
use App\Models\Buku;
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
            'user_id' => 'required|exists:users,id', // pastikan user_id ada
            'no_telp' => 'required',
            'alamat'  => 'required',
        ]);

        // Cek apakah user tersebut sudah jadi anggota
        $cek = Anggota::where('user_id', $request->user_id)->first();
        if ($cek) {
            return redirect()->back()->with('error', 'User ini sudah terdaftar sebagai anggota.');
        }

        Anggota::create([
            'user_id'        => $request->user_id, // ambil dari form
            'no_telp'        => $request->no_telp,
            'alamat'         => $request->alamat,
            'tanggal_daftar' => now(),
            'status_anggota' => 'aktif'
        ]);

        // Jika yang login admin, balik ke manage murid. Jika murid, balik ke dashboard.
        $url = auth()->user()->role == 'admin' ? '/admin/list-murid' : '/dashboard';

        return redirect($url)->with('success', 'Berhasil mendaftar anggota.');
    }
    public function welcomePage()
    {
        $totalBuku = Buku::count();
        $totalAnggota = Anggota::count();
        $totalTransaksi = Transaksi::count();


        return view('welcome', compact('totalBuku', 'totalAnggota', 'totalTransaksi'));
    }

    public function dashboard()
    {
        $user = auth()->user();

        $isActive = $user->anggota && $user->anggota->status_anggota === 'aktif';

        $aktivitas = collect();
        $jumlahDipinjam = 0;
        $jumlahMenunggu = 0;
        $jumlahKembali = 0;

        if ($isActive) {
            $idAnggota = $user->anggota->id;

            $jumlahDipinjam = Transaksi::where('anggota_id', $idAnggota)
                ->where('status', 'dipinjam')->count();

            $jumlahMenunggu = Transaksi::where('anggota_id', $idAnggota)
                ->whereIn('status', ['menunggu_pinjam', 'menunggu_pengembalian'])->count();

            $jumlahKembali = Transaksi::where('anggota_id', $idAnggota)
                ->where('status', 'dikembalikan')->count();

            $aktivitas = Transaksi::with('buku')
                ->where('anggota_id', $idAnggota)
                ->latest()->take(5)->get();
        } 
        return view('user.dashboard', compact(
            'isActive',
            'aktivitas',
            'jumlahDipinjam',
            'jumlahMenunggu',
            'jumlahKembali'
        ));
    }
}
