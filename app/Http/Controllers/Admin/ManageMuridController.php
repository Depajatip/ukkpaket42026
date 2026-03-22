<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class ManageMuridController extends Controller
{
    public function index(Request $request)
    {
        $listMurid = User::with('anggota')
            ->where('role', 'user')
            ->when($request->search, function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('nama_siswa', 'like', '%' . $search . '%')
                        ->orWhere('nis', 'like', '%' . $search . '%')
                        ->orWhere('kelas', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->get();

        return view('admin.managemurid', compact('listMurid'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:users,nis',
            'nama_siswa' => 'required|unique:users,nama_siswa',
            'kelas' => 'required',
            'password' => 'required|min:6'
        ], [
            'nis.unique' => 'NIS sudah terdaftar',
            'nis.required' => 'NIS wajib diisi',
            'nama_siswa.unique' => 'Nama siswa sudah terdaftar',
            'nama_siswa.required' => 'Nama siswa wajib diisi',
        ]);

        User::create([
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'kelas' => $request->kelas,
            'password' => bcrypt($request->password),
            'role' => 'user'
        ]);

        return back()->with('success', 'Murid berhasil ditambahkan');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Data Murid berhasil dihapus');
    }
    public function update(Request $request, $id)
    {
        $murid = User::findOrFail($id);

        $request->validate([
            'nis' => 'required|unique:users,nis,' . $id,
            'nama_siswa' => 'required',
            'kelas' => 'required',
        ], [
            'nis.unique' => 'NIS sudah terdaftar',
            'nama_siswa.required' => 'Nama siswa wajib diisi',
        ]);

        $murid->update([
            'nis' => $request->nis,
            'nama_siswa' => $request->nama_siswa,
            'kelas' => $request->kelas,
        ]);

        return back()->with('success', 'Data murid berhasil diupdate');
    }
}
