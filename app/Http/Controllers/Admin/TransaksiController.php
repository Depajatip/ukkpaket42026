<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with(['user', 'buku'])
            ->latest()
            ->get();

        return view('admin.transaksi.index', compact('transaksi'));
    }

public function approve(Transaksi $transaksi)
{
    if ($transaksi->status !== 'menunggu_pinjam') {
        return back()->with('error', 'Transaksi sudah diproses');
    }

    if ($transaksi->buku->stok < 1) {
        return back()->with('error', 'Stok buku habis');
    }

    $transaksi->update([
        'status' => 'dipinjam',
        'tanggal_disetujui' => now(),
    ]);

    $transaksi->buku->decrement('stok');

    return back()->with('success', 'Peminjaman disetujui');
}

    public function reject(Transaksi $transaksi)
    {
        $transaksi->update([
            'status' => 'ditolak',
        ]);

        return back()->with('success', 'Peminjaman ditolak');
    }

public function return(Transaksi $transaksi)
{
    if ($transaksi->status !== 'menunggu_pengembalian') {
        return back()->with('error', 'Transaksi belum diajukan pengembalian');
    }

    // Tambahkan tanggal kembali
    $transaksi->update([
        'status' => 'dikembalikan',
        'tanggal_kembali' => now(),
    ]);

    // Kembalikan stok
    $transaksi->buku->increment('stok');

    return back()->with('success', 'Pengembalian disetujui');
}
public function history()
{
    $transaksi = Transaksi::with('buku')
        ->where('user_id', auth()->id())
        ->where('status', 'dikembalikan')
        ->latest()
        ->paginate(6);

    return view('buku.history', compact('transaksi'));
}
}
