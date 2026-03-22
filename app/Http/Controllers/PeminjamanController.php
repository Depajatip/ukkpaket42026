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

        $anggota = $user->anggota;

        // 2. Cek stok
        if ($buku->stok < 1) {
            return back()->with('error', 'Stok buku habis');
        }

        // 3. Cek pinjaman aktif
        $aktif = Transaksi::where('anggota_id', $anggota->id)
            ->where('buku_id', $buku->id)
            ->whereIn('status', ['menunggu_pinjam', 'dipinjam'])
            ->exists();

        if ($aktif) {
            return back()->with('error', 'Buku ini sudah kamu pinjam');
        }

        // 4. Simpan transaksi
        Transaksi::create([
            'anggota_id' => $anggota->id,
            'buku_id' => $buku->id,
            'tanggal_pinjam' => now(),
            'status' => 'menunggu_pinjam',
        ]);

        return redirect()->route('buku.index')
            ->with('success', 'Permintaan peminjaman dikirim, menunggu persetujuan admin');
    }

    public function index()
    {
        $transaksi = Transaksi::with(['anggota.user', 'buku'])
            ->latest()
            ->get();

        return view('admin.transaksi.index', compact('transaksi'));
    }

    public function ajukanPengembalian(Transaksi $transaksi)
    {
        $user = auth()->user();

        if (!$user->anggota || $transaksi->anggota_id !== $user->anggota->id) {
            abort(403);
        }

        if ($transaksi->status !== 'dipinjam') {
            return back()->with('error', 'Transaksi tidak bisa diajukan pengembalian');
        }

        $transaksi->update([
            'status' => 'menunggu_pengembalian'
        ]);

        return back()->with('success', 'Pengembalian diajukan, menunggu persetujuan admin');
    }

    public function historyPinjaman(Request $request)
{
    $user = auth()->user();

    // cek apakah user punya anggota
    if (!$user->anggota) {
        return back()->with('error', 'Kamu belum terdaftar sebagai anggota');
    }

    $search = $request->search;

    // query dasar
    $history = Transaksi::with('buku')
        ->where('anggota_id', $user->anggota->id)
        ->whereIn('status', ['dikembalikan', 'ditolak']);

    // fitur search
    if ($search) {

        $history->where(function ($query) use ($search) {

            $query->where('id', 'like', "%$search%")
                ->orWhere('tanggal_pinjam', 'like', "%$search%")
                ->orWhere('tanggal_kembali', 'like', "%$search%")
                ->orWhere('status', 'like', "%$search%")
                ->orWhereHas('buku', function ($q) use ($search) {

                    $q->where('judul_buku', 'like', "%$search%")
                        ->orWhere('pengarang', 'like', "%$search%")
                        ->orWhere('tahun_terbit', 'like', "%$search%")
                        ->orWhere('penerbit', 'like', "%$search%");
                });

        });

    }

    // ambil data terbaru
    $history = $history->latest()->get();

    // jika request ajax (untuk live search)
    if ($request->ajax()) {
        return view('buku.gridhistory', compact('history'))->render();
    }

    return view('buku.history', compact('history'));
}
}
