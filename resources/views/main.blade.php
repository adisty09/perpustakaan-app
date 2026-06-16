<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Perpustakaan Daerah - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: #f0f2f5; }
        #sidebar-wrapper {
            width: 280px;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            height: 100vh;
            position: fixed;
            transition: all 0.3s;
            z-index: 1040;
        }
        #page-content-wrapper {
            margin-left: 280px;
            width: calc(100% - 280px);
            min-height: 100vh;
        }
        @media (max-width: 991.98px) {
            #sidebar-wrapper { margin-left: -280px; }
            #page-content-wrapper { margin-left: 0; width: 100%; }
            #wrapper.toggled #sidebar-wrapper { margin-left: 0; }
        }
        .sidebar-brand { padding: 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-menu .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 0.75rem 1.5rem;
            margin: 4px 0;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .sidebar-menu .nav-link:hover, .sidebar-menu .nav-link.active {
            background: rgba(255,255,255,0.15);
            color: white;
        }
        .card { border-radius: 16px; border: none; box-shadow: 0 2px 12px rgba(0,0,0,0.05); }
        .btn-primary { background: #2a5298; border: none; border-radius: 10px; }
        .btn-primary:hover { background: #1e3c72; }
        .table thead th { background: #f8f9fa; font-weight: 600; font-size: 0.75rem; text-transform: uppercase; padding: 1rem; }
        .table tbody td { padding: 0.85rem 1rem; vertical-align: middle; }
    </style>
    @stack('styles')
</head>
<body>
<div id="wrapper">
    <div id="sidebar-wrapper">
        <div class="sidebar-brand text-center">
            <i class="bi bi-book-half fs-1 text-white"></i>
            <h5 class="text-white mt-2 mb-0">PerpusDaerah</h5>
            <small class="text-white-50">Kota Palembang</small>
        </div>
        <nav class="sidebar-menu flex-grow-1">
            <div class="nav flex-column">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
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
                <a class="nav-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}" href="{{ route('peminjaman.index') }}">
                    <i class="bi bi-hand-index-thumb"></i> Peminjaman
                </a>
                <a class="nav-link {{ request()->routeIs('pengembalian.*') ? 'active' : '' }}" href="{{ route('pengembalian.index') }}">
                    <i class="bi bi-arrow-return-left"></i> Pengembalian
                </a>
                <hr style="border-color: rgba(255,255,255,0.1); margin: 0.5rem 0;">
                <a class="nav-link" data-bs-toggle="collapse" href="#laporanMenu">
                    <i class="bi bi-graph-up"></i> Laporan <i class="bi bi-chevron-down float-end"></i>
                </a>
                <div class="collapse ms-3" id="laporanMenu">
                    <a class="nav-link ps-4" href="{{ route('laporan.buku-terpopuler') }}"><i class="bi bi-bar-chart"></i> Buku Terpopuler</a>
                    <a class="nav-link ps-4" href="{{ route('laporan.denda-per-anggota') }}"><i class="bi bi-cash-stack"></i> Denda per Anggota</a>
                </div>
            </div>
        </nav>
        <div class="p-3 border-top" style="border-color: rgba(255,255,255,0.1) !important;">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100 btn-sm">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg bg-white shadow-sm px-4 py-3 sticky-top">
            <div class="container-fluid">
                <button class="btn btn-light d-lg-none border" id="sidebarToggle">
                    <i class="bi bi-list fs-5"></i>
                </button>
                <div class="ms-auto">
                    <div class="dropdown">
                        <button class="btn btn-light rounded-circle p-2" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle fs-5"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><span class="dropdown-item-text">{{ Auth::user()->name ?? 'Admin' }}</span></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container-fluid px-4 py-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-3">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-3">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>
        <footer class="text-center text-muted py-3 border-top mt-4">
            @yield('footer')
            <p class="mb-0 small">&copy; {{ date('Y') }} Dinas Kearsipan dan Perpustakaan Kota Palembang</p>
        </footer>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('sidebarToggle')?.addEventListener('click', function() {
        document.getElementById('wrapper').classList.toggle('toggled');
    });
    document.querySelectorAll('.show_confirm').forEach(el => {
        el.addEventListener('click', function(e) {
            e.preventDefault();
            let form = this.closest('form');
            let nama = this.dataset.nama || 'data ini';
            Swal.fire({
                title: 'Yakin hapus?',
                text: 'Data "' + nama + '" akan dihapus permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => { if (result.isConfirmed) form.submit(); });
        });
    });
</script>
@stack('scripts')
</body>
</html>