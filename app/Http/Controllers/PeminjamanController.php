<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function store(Buku $buku)
    {
        $user = auth()->user();

        // 1. Cek anggota
        if (!$user->anggota) {
            return back()->with('error', 'Kamu belum terdaftar sebagai anggota');
        }

        // 2. Cek stok
        if ($buku->stok < 1) {
            return back()->with('error', 'Stok buku habis');
        }

        // 3. Cek pinjaman aktif
        $aktif = Transaksi::where('user_id', $user->id)
            ->where('buku_id', $buku->id)
            ->whereIn('status', ['menunggu_pinjam', 'dipinjam'])
            ->exists();

        if ($aktif) {
            return back()->with('error', 'Buku ini sudah kamu pinjam');
        }

        // 4. Simpan transaksi (MENUNGGU ACC)
        Transaksi::create([
            'user_id' => $user->id,
            'buku_id' => $buku->id,
            'tanggal_pinjam' => now(),
            'status' => 'menunggu_pinjam',
        ]);

        return back()->with('success', 'Permintaan peminjaman dikirim, menunggu persetujuan admin');
    }

    public function index()
    {
        $transaksi = Transaksi::with(['user', 'buku'])
            ->latest()
            ->get();

        return view('admin.transaksi.index', compact('transaksi'));
    }

    public function ajukanPengembalian(Transaksi $transaksi)
{
    if ($transaksi->user_id !== auth()->id()) abort(403);

    if ($transaksi->status !== 'dipinjam') {
        return back()->with('error', 'Status tidak valid');
    }

    $transaksi->update([
        'status' => 'menunggu_pengembalian'
    ]);

    return back()->with('success', 'Pengembalian diajukan, menunggu persetujuan admin');
}
}
