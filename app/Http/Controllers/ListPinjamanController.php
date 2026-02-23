<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Transaksi;

class ListPinjamanController extends Controller
{
    public function aktif()
{
    $transaksi = Transaksi::with('buku')
        ->where('user_id', auth()->id())
        ->whereIn('status', ['menunggu_pinjam', 'dipinjam', 'menunggu_pengembalian'])
        ->latest()
        ->get();

    return view('buku.listpinjaman', compact('transaksi'));
}
}
