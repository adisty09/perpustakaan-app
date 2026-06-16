@extends('main')

@section('title', 'Data Buku')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-book me-2"></i>Data Buku</h5>
        <a href="{{ route('buku.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Buku
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>ISBN</th>
                        <th>Tahun</th>
                        <th>Penerbit</th>
                        <th>Jenis</th>
                        <th>Stok</th>
                        <th>Tersedia</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bukus as $buku)
                    <tr>
                        <td>{{ $buku->idBuku }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->isbn ?? '-' }}</td>
                        <td>{{ $buku->tahunTerbit }}</td>
                        <td>{{ $buku->penerbit->nama ?? '-' }}</td>
                        <td>{{ $buku->jenisBuku->namaJenis ?? '-' }}</td>
                        <td>{{ $buku->stok_total }}</td>
                        <td>
                            <span class="badge {{ $buku->stok_tersedia > 0 ? 'bg-success' : 'bg-danger' }}">
                                {{ $buku->stok_tersedia }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('buku.edit', $buku->idBuku) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('buku.destroy', $buku->idBuku) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm show_confirm" data-nama="Buku {{ $buku->judul }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">Belum ada data buku</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $bukus->links() }}
        </div>
    </div>
</div>
@endsection