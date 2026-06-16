<nav class="sidebar-menu flex-grow-1">
    <div class="nav flex-column">
        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        
        <div class="nav-header px-3 py-2 text-uppercase small fw-bold text-white-50">Master Data</div>
        
        <a class="nav-link {{ request()->routeIs('anggota.*') ? 'active' : '' }}" href="{{ route('anggota.index') }}">
            <i class="bi bi-people"></i> Anggota
        </a>
        <a class="nav-link {{ request()->routeIs('buku.*') ? 'active' : '' }}" href="{{ route('buku.index') }}">
            <i class="bi bi-book"></i> Buku
        </a>
        <a class="nav-link {{ request()->routeIs('penerbit.*') ? 'active' : '' }}" href="{{ route('penerbit.index') }}">
            <i class="bi bi-building"></i> Penerbit
        </a>
        <a class="nav-link {{ request()->routeIs('jenis-buku.*') ? 'active' : '' }}" href="{{ route('jenis-buku.index') }}">
            <i class="bi bi-tags"></i> Jenis Buku
        </a>
        <a class="nav-link {{ request()->routeIs('pengarang.*') ? 'active' : '' }}" href="{{ route('pengarang.index') }}">
            <i class="bi bi-pen"></i> Pengarang
        </a>
        <a class="nav-link {{ request()->routeIs('rak-buku.*') ? 'active' : '' }}" href="{{ route('rak-buku.index') }}">
            <i class="bi bi-grid-3x3-gap-fill"></i> Rak Buku
        </a>
        <a class="nav-link {{ request()->routeIs('pustakawan.*') ? 'active' : '' }}" href="{{ route('pustakawan.index') }}">
            <i class="bi bi-person-badge"></i> Pustakawan
        </a>
        
        <hr style="border-color: rgba(255,255,255,0.1); margin: 0.5rem 0;">
        
        <div class="nav-header px-3 py-2 text-uppercase small fw-bold text-white-50">Transaksi</div>
        
        <a class="nav-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}" href="{{ route('peminjaman.index') }}">
            <i class="bi bi-hand-index-thumb"></i> Peminjaman
        </a>
        <a class="nav-link {{ request()->routeIs('pengembalian.*') ? 'active' : '' }}" href="{{ route('pengembalian.index') }}">
            <i class="bi bi-arrow-return-left"></i> Pengembalian
        </a>
        
        <hr style="border-color: rgba(255,255,255,0.1); margin: 0.5rem 0;">
        
        <div class="nav-header px-3 py-2 text-uppercase small fw-bold text-white-50">Laporan</div>
        
        <a class="nav-link {{ request()->routeIs('laporan.buku-terpopuler') ? 'active' : '' }}" href="{{ route('laporan.buku-terpopuler') }}">
            <i class="bi bi-bar-chart"></i> Buku Terpopuler
        </a>
        <a class="nav-link {{ request()->routeIs('laporan.denda-per-anggota') ? 'active' : '' }}" href="{{ route('laporan.denda-per-anggota') }}">
            <i class="bi bi-cash-stack"></i> Denda per Anggota
        </a>
        
        <hr style="border-color: rgba(255,255,255,0.1); margin: 0.5rem 0;">
        
        @if(Auth::user() && Auth::user()->role == 'superadmin')
        <div class="nav-header px-3 py-2 text-uppercase small fw-bold text-white-50">Admin</div>
        <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
            <i class="bi bi-shield-lock"></i> Manajemen User
        </a>
        @endif
    </div>
</nav>