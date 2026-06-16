@extends('main')

@section('title', 'Data Jenis Buku')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-tags me-2"></i>Data Jenis Buku</h5>
        <a href="{{ route('jenis-buku.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Jenis Buku
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Jenis</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jenisBukus as $jenis)
                    <tr>
                        <td>{{ $jenis->idJenis }}</td>
                        <td>{{ $jenis->namaJenis }}</td>
                        <td>{{ $jenis->deskripsi ?? '-' }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('jenis-buku.edit', $jenis->idJenis) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('jenis-buku.destroy', $jenis->idJenis) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm show_confirm" data-nama="Jenis Buku {{ $jenis->namaJenis }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada data jenis buku</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $jenisBukus->links() }}
        </div>
    </div>
</div>
@endsection