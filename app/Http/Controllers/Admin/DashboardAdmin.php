<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardAdmin extends Controller
{
    public function index(Request $request)
    {
        $totalBuku = Buku::count();
        $totalAnggota = Anggota::count();
        $totalTransaksi = Transaksi::count();
        $jumlahMenunggu = Transaksi::whereIn('status', ['menunggu_pinjam', 'menunggu_pengembalian'])->count();

        $dikembalikan = Transaksi::where('status', 'dikembalikan')->count();
        $persenKembali = $totalTransaksi > 0 ? round(($dikembalikan / $totalTransaksi) * 100) : 0;

        $bukuPopuler = Transaksi::select('buku_id', DB::raw('count(*) as total'))
            ->with('buku')
            ->groupBy('buku_id')
            ->orderBy('total', 'desc')
            ->take(3)
            ->get();

        // --- LOGIKA CHART (FILTER) ---
        $filter = $request->get('filter', 'mingguan');
        $chartLabels = [];
        $chartData = [];

        if ($filter == 'bulanan') {
            for ($i = 5; $i >= 0; $i--) {
                $month = Carbon::now()->subMonths($i);
                $chartLabels[] = $month->translatedFormat('M');
                $chartData[] = Transaksi::whereYear('created_at', $month->year)
                    ->whereMonth('created_at', $month->month)
                    ->count();
            }
        } else {
            for ($i = 6; $i >= 0; $i--) {
                $day = Carbon::now()->subDays($i);
                $chartLabels[] = $day->translatedFormat('D');
                $chartData[] = Transaksi::whereDate('created_at', $day->toDateString())->count();
            }
        }

        // List Transaksi Terbaru
        $aktivitasTransaksi = Transaksi::with(['anggota.user', 'buku'])->latest()->take(10)->get();

        // List Anggota Baru (Ditambah NIS)
        $anggotaBaru = Anggota::with('user')->latest()->take(6)->get();

        return view('admin.dashboard', compact(
            'totalBuku',
            'totalAnggota',
            'totalTransaksi',
            'jumlahMenunggu',
            'chartLabels',
            'chartData',
            'filter',
            'aktivitasTransaksi',
            'anggotaBaru',
            'dikembalikan',
            'persenKembali',
            'bukuPopuler'
        ));
    }
}
