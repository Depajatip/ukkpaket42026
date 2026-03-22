<div class="sidebar shadow">
    <div class="p-4 text-center border-bottom border-secondary mb-3">
        <h4 class="text-white mb-0">📚 Perpustakaan</h4>
    </div>

    <div class="nav flex-column">
        <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
            <i class="fas fa-chart-pie me-3"></i> Dashboard
        </a>
        <a href="{{ route('admin.buku.index') }}" class="{{ request()->routeIs('admin.buku.*') ? 'active' : '' }}">
            <i class="fas fa-book me-3"></i> Manajemen Buku
        </a>
        <a href="{{ route('admin.manageanggota.index') }}" class="{{ request()->routeIs('admin.manageanggota.*') ? 'active' : '' }}">
            <i class="fas fa-users me-3"></i> Manajemen Anggota
        </a>
        <a href="{{ route('admin.managemurid.index') }}" class="{{ request()->routeIs('admin.managemurid.*') ? 'active' : '' }}">
            <i class="fas fa-users me-3"></i> Manajemen Murid
        </a>
        <a href="{{ route('admin.transaksi.index') }}" class="{{ request()->routeIs('admin.transaksi.*') ? 'active' : '' }}">
            <i class="fas fa-book-reader me-3"></i> Transaksi
        </a>
        <a href="{{ route('admin.historytransaksi') }}" class="{{ request()->routeIs('admin.historytransaksi') ? 'active' : '' }}">
            <i class="fas fa-history me-3"></i> History Transaksi
        </a>

        <div class="px-3 mt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 rounded-pill btn-sm">
                    <i class="fas fa-sign-out-alt me-1"></i> Logout
                </button>
            </form>
        </div>
    </div>
</div>