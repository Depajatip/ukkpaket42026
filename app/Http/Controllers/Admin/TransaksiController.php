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

        $transaksi->update([
            'status' => 'dipinjam',
            'tanggal_disetujui' => now(),
        ]);

        // kurangi stok
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
        return back()->with('error', 'Status tidak valid');
    }

    $transaksi->update([
        'status' => 'dikembalikan',
        'tanggal_kembali' => now(),
    ]);

    $transaksi->buku->increment('stok');

    return back()->with('success', 'Pengembalian disetujui');
}
}
