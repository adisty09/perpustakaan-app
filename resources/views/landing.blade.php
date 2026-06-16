<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Daerah Palembang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
        }

        .hero-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 28px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .btn-custom {
            background: #2a5298;
            color: white;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
        }

        .btn-custom:hover {
            background: #1e3c72;
            color: white;
        }

        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            transition: transform 0.3s;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="hero-card p-5">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ asset('images/building.png') }}" alt="Logo Perpustakaan"
                            style="height: 50px; width: 50px; object-fit: contain;">
                        <h1 class="display-4 fw-bold" style="color: #1e3c72;">Perpustakaan Daerah</h1>
                    </div>
                    <p class="lead text-muted mt-3">Dinas Kearsipan dan Perpustakaan Kota Palembang</p>
                    <p class="mb-4">Sistem informasi perpustakaan digital untuk memudahkan layanan peminjaman buku,
                        pengelolaan anggota, dan pelaporan transaksi secara terintegrasi.</p>
                    <div class="d-flex gap-3">
                        <a href="{{ route('login') }}" class="btn btn-custom">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Login
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-light btn-custom"
                            style="background: white; border: 2px solid #2a5298; color: #2a5298;">
                            <i class="bi bi-person-plus me-2"></i> Sign Up
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 text-center">
                    <img src="{{ asset('images/image.jpg') }}" alt="Perpustakaan Daerah Palembang"
                        class="img-fluid rounded-4 shadow" style="height: 300px; width: 100%; object-fit: cover;">
                </div>
            </div>
        </div>

        <div class="row mt-5 g-4">
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="bi bi-people fs-1 text-primary"></i>
                    <h5 class="mt-3">Manajemen Anggota</h5>
                    <p class="text-muted">Kelola data anggota perpustakaan dengan mudah dan terstruktur.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="bi bi-book fs-1 text-primary"></i>
                    <h5 class="mt-3">Koleksi Buku</h5>
                    <p class="text-muted">Database lengkap koleksi buku dengan kategori, penerbit, dan pengarang.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="bi bi-hand-index-thumb fs-1 text-primary"></i>
                    <h5 class="mt-3">Transaksi Peminjaman</h5>
                    <p class="text-muted">Proses peminjaman dan pengembalian buku dengan sistem denda otomatis.</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
