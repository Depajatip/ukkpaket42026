<?php

namespace App\Http\Controllers;


use App\Models\Buku;
use App\Models\Transaksi;

class ListPinjamanController extends Controller
{
public function aktif()
{
    $user = auth()->user();

    if (!$user->anggota) {
        abort(403);
    }

    $transaksi = Transaksi::with('buku')
        ->where('anggota_id', $user->anggota->id)
        ->whereIn('status', ['menunggu_pinjam', 'dipinjam', 'menunggu_pengembalian'])
        ->latest()
        ->get();

    return view('buku.listpinjaman', compact('transaksi'));
}
}
