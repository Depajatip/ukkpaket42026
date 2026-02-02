<?php

namespace App\Http\Controllers;

use App\Models\Buku;

class BukuSiswaController extends Controller
{
    public function index()
    {
        $buku = Buku::latest()->get();

        return view('buku.index', compact('buku'));
    }
}
