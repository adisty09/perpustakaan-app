@extends('main')

@section('title', 'Data Rak Buku')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-grid-3x3-gap-fill me-2"></i>Data Rak Buku</h5>
        <a href="{{ route('rak-buku.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Rak
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode Rak</th>
                        <th>Lokasi</th>
                        <th>Lantai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rakBukus as $rak)
                    <tr>
                        <td>{{ $rak->idRak }}</td>
                        <td>{{ $rak->kodeRak }}</td>
                        <td>{{ $rak->lokasi ?? '-' }}</td>
                        <td>{{ $rak->lantai }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('rak-buku.edit', $rak->idRak) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('rak-buku.destroy', $rak->idRak) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm show_confirm" data-nama="Rak {{ $rak->kodeRak }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data rak</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $rakBukus->links() }}
        </div>
    </div>
</div>
@endsection