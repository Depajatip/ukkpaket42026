<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\User;


class ManageAnggotaController extends Controller
{
    public function index(Request $request)
    {
        $anggota = Anggota::with('user')
            ->when($request->search, function ($query) use ($request) {
                $search = $request->search;

                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('nama_siswa', 'like', '%' . $search . '%')
                        ->orWhere('nis', 'like', '%' . $search . '%')
                        ->orWhere('kelas', 'like', '%' . $search . '%');
                })
                    ->orWhere('alamat', 'like', '%' . $search . '%')
                    ->orWhere('no_telp', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();

        return view('admin.manageanggota', compact('anggota'));
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();

        return redirect()->back()->with('success', 'Data anggota berhasil dihapus');
    }
    public function edit($id)
    {
        $anggota = Anggota::findOrFail($id);

        return view('admin.editanggota', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_telp' => 'required',
            'alamat'  => 'required',
        ]);

        $anggota = Anggota::findOrFail($id);
        $anggota->update([
            'no_telp'        => $request->no_telp,
            'alamat'         => $request->alamat,
        ]);

        return redirect()->back()->with('success', 'Data anggota ' . $anggota->user->nama_siswa . ' berhasil diupdate!');
    }
    public function create(Request $request)
    {
        $selectedUser = null;
        if ($request->has('id')) {
            $selectedUser = User::find($request->id);
        }

        return view('anggota.create', compact('selectedUser'));
    }
}
