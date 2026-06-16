@extends('main')

@section('title', 'Data Pustakawan')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-person-badge me-2"></i>Data Pustakawan</h5>
        <a href="{{ route('pustakawan.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Pustakawan
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>No Telepon</th>
                        <th>Gaji Pokok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pustakawans as $pustakawan)
                    <tr>
                        <td>{{ $pustakawan->idPustakawan }}</td>
                        <td>{{ $pustakawan->nama }}</td>
                        <td>{{ $pustakawan->jabatan }}</td>
                        <td>{{ $pustakawan->no_telp ?? '-' }}</td>
                        <td>Rp {{ number_format($pustakawan->gaji_pokok, 0, ',', '.') }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('pustakawan.edit', $pustakawan->idPustakawan) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('pustakawan.destroy', $pustakawan->idPustakawan) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm show_confirm" data-nama="Pustakawan {{ $pustakawan->nama }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada data pustakawan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $pustakawans->links() }}
        </div>
    </div>
</div>
@endsection