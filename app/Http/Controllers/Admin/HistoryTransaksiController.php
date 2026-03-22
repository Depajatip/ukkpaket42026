<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;


class HistoryTransaksiController extends Controller
{
    public function history(Request $request)
    {
        $search = $request->search;
        $sort = $request->get('sort', 'transaksi.id');
        $order = $request->get('order', 'desc');

        $allowedSort = [
            'id' => 'transaksi.id',
            'nis' => 'users.nis',
            'nama' => 'users.nama_siswa',
            'buku' => 'buku.judul_buku',
            'tanggal_pinjam' => 'transaksi.tanggal_pinjam',
            'tanggal_kembali' => 'transaksi.tanggal_kembali',
            'status' => 'transaksi.status'
        ];

        $sortColumn = $allowedSort[$sort] ?? 'transaksi.id';
        $order = ($order === 'asc') ? 'asc' : 'desc';

        $historytransaksi = Transaksi::query()
            ->select('transaksi.*')
            ->join('anggota', 'transaksi.anggota_id', '=', 'anggota.id')
            ->join('users', 'anggota.user_id', '=', 'users.id')
            ->join('buku', 'transaksi.buku_id', '=', 'buku.id')
            ->whereIn('transaksi.status', ['dikembalikan', 'ditolak'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('transaksi.id', 'like', "%$search%")
                        ->orWhere('users.nama_siswa', 'like', "%$search%")
                        ->orWhere('users.nis', 'like', "%$search%")
                        ->orWhere('buku.judul_buku', 'like', "%$search%");
                });
            })
            ->orderBy($sortColumn, $order)
            ->paginate(10);

        return view('admin.historytransaksi', compact('historytransaksi'));
    }
}
