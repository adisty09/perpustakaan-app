@extends('main')

@section('title', 'Data Anggota')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-people me-2"></i>Data Anggota</h5>
        <a href="{{ route('anggota.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Anggota
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No Telepon</th>
                        <th>Email</th>
                        <th>Tgl Daftar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($anggotas as $anggota)
                    <tr>
                        <td>{{ $anggota->idAnggota }}</td>
                        <td>{{ $anggota->nama }}</td>
                        <td>{{ $anggota->alamat ?? '-' }}</td>
                        <td>{{ $anggota->no_telp ?? '-' }}</td>
                        <td>{{ $anggota->email ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($anggota->tgl_daftar)->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge {{ $anggota->status == 'Aktif' ? 'bg-success' : 'bg-secondary' }}">
                                {{ $anggota->status }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('anggota.edit', $anggota->idAnggota) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('anggota.destroy', $anggota->idAnggota) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm show_confirm" data-nama="Anggota {{ $anggota->nama }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Belum ada data anggota</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $anggotas->links() }}
        </div>
    </div>
</div>
@endsection