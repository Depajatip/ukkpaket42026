<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class ListPinjamanController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        if (!$user->anggota) {
            return back()->with('error', 'Kamu belum terdaftar sebagai anggota');
        }

        $search = $request->search;

        $transaksi = Transaksi::with('buku')
            ->where('anggota_id', $user->anggota->id)
            ->whereIn('status', [
                'menunggu_pinjam',
                'dipinjam',
                'menunggu_pengembalian'
            ]);

        if ($search) {

            $transaksi->where(function ($query) use ($search) {

                $query->where('id', 'like', "%$search%")
                    ->orWhere('tanggal_pinjam', 'like', "%$search%")
                    ->orWhere('status', 'like', "%$search%")
                    ->orWhereHas('buku', function ($q) use ($search) {

                        $q->where('judul_buku', 'like', "%$search%")
                            ->orWhere('pengarang', 'like', "%$search%")
                            ->orWhere('tahun_terbit', 'like', "%$search%")
                            ->orWhere('penerbit', 'like', "%$search%");
                    });
            });
        }

        $transaksi = $transaksi->latest()->get();

        if ($request->ajax()) {
            return view('buku.gridpinjam', compact('transaksi'))->render();
        }

        return view('buku.listpinjaman', compact('transaksi'));
    }
}
