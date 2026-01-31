<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'nis' => ['required', 'string', 'max:255', 'unique:users'],
        'nama_siswa' => ['required', 'string'],
        'kelas' => ['required', 'string'],
        'password' => ['required', 'confirmed', 'min:6'],
    ]);

    $user = User::create([
        'nis' => $request->nis,
        'nama_siswa' => $request->nama_siswa,
        'kelas' => $request->kelas,
        'password' => Hash::make($request->password),
        'role' => 'user',
    ]);

    event(new Registered($user));

    return redirect('/login')
        ->with('success', 'Registrasi berhasil, silakan login.');
}
}
