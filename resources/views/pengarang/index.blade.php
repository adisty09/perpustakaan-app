@extends('main')

@section('title', 'Data Pengarang')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-pen me-2"></i>Data Pengarang</h5>
        <a href="{{ route('pengarang.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Pengarang
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Negara</th>
                        <th>Tanggal Lahir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengarangs as $pengarang)
                    <tr>
                        <td>{{ $pengarang->idPengarang }}</td>
                        <td>{{ $pengarang->nama }}</td>
                        <td>{{ $pengarang->negara ?? '-' }}</td>
                        <td>{{ $pengarang->tgl_lahir ? \Carbon\Carbon::parse($pengarang->tgl_lahir)->format('d/m/Y') : '-' }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('pengarang.edit', $pengarang->idPengarang) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('pengarang.destroy', $pengarang->idPengarang) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm show_confirm" data-nama="Pengarang {{ $pengarang->nama }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data pengarang</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $pengarangs->links() }}
        </div>
    </div>
</div>
@endsection