<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuSiswaController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->search;

        $buku = Buku::query();

        if ($search) {
            $buku->where('judul_buku', 'like', "%{$search}%")
                ->orWhere('pengarang', 'like', "%{$search}%")
                ->orWhere('penerbit', 'like', "%{$search}%")
                ->orWhere('tahun_terbit', 'like', "%{$search}%");
        }

        $buku = $buku->latest()->paginate(9);

        if ($request->ajax()) {
            return view('buku.gridkatalog', compact('buku'))->render();
        }

        return view('buku.index', compact('buku', 'search'));
    }
}
