<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Transaksi;

class ListPinjamanController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $transaksi = Transaksi::all();

        return view('buku.listpinjaman', compact('transaksi'));

    }
}
