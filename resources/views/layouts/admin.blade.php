<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - Perpustakaan</title>

    @vite(['resources/js/app.js'])
</head>

<body class="bg-light">

    <div class="d-flex" style="min-height: 100vh">

        {{-- SIDEBAR --}}
        <div class="bg-dark text-white p-3" style="width: 260px">
            <h5 class="fw-bold mb-4">📚 Admin Perpus</h5>

            <ul class="nav flex-column gap-2">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link text-white">
                        🏠 Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.buku.index') }}"
                        class="nav-link text-white">
                        📘 Manajemen Buku
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#"
                        class="nav-link text-white disabled">
                        👥 Anggota
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#"
                        class="nav-link text-white disabled">
                        🔁 Peminjaman
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.transaksi.index') }}">
                        📑 ACC Peminjaman
                    </a>
                </li>
            </ul>
        </div>

        {{-- MAIN --}}
        <div class="flex-grow-1">
            {{-- NAVBAR --}}
            <nav class="navbar navbar-light bg-white shadow-sm px-4">
                <span class="fw-semibold">
                    Halo, {{ auth()->user()->nama_siswa ?? 'Admin' }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-sm btn-outline-danger">
                        Logout
                    </button>
                </form>
            </nav>

            {{-- CONTENT --}}
            <main class="p-4">
                @yield('content')
            </main>
        </div>

    </div>

</body>

</html>