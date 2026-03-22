<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $buku = Buku::latest()
            ->when($request->search, function ($query) use ($request) {
                $query->where('judul_buku', 'like', '%' . $request->search . '%')
                    ->orWhere('pengarang', 'like', '%' . $request->search . '%')
                    ->orWhere('penerbit', 'like', '%' . $request->search . '%')
                    ->orWhere('tahun_terbit', 'like', '%' . $request->search . '%');
            })
            ->get();

        return view('admin.buku.index', compact('buku'));
    }

    public function create()
    {
        return view('admin.buku.create');
    }
public function store(Request $request)
{
    $request->validate([
        'judul_buku' => 'required',
        'pengarang' => 'required',
        'penerbit' => 'required',
        'tahun_terbit' => 'required|integer|min:1901|max:2155', // Batas aman MySQL YEAR
        'stok' => 'required|integer|min:0',
        'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ], [
        // Custom feedback text
        'tahun_terbit.max' => 'Waduh! Tahun terbit tidak boleh lebih dari 2155 karena batasan sistem.',
        'tahun_terbit.integer' => 'Tahun terbit harus berupa angka ya!',
    ]);

    $data = $request->all();

    if ($request->hasFile('gambar')) {
        $data['gambar'] = $request->file('gambar')->store('buku', 'public');
    }

    try {
        Buku::create($data);
        return redirect()->route('admin.buku.index')
            ->with('success', 'Sip! Buku berhasil ditambahkan.');
    } catch (\Exception $e) {
        // Jika masih ada error database tak terduga
        return back()->withInput()->with('error_sistem', 'Gagal menyimpan: ' . $e->getMessage());
    }
}

    public function edit(Buku $buku)
    {
        return view('admin.buku.edit', compact('buku'));
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'judul_buku' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($buku->gambar && Storage::disk('public')->exists($buku->gambar)) {
                Storage::disk('public')->delete($buku->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('buku', 'public');
        }

        $buku->update($data);

        return redirect()->route('admin.buku.index')
            ->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();

        return back()->with('success', 'Buku berhasil dihapus');
    }
}
