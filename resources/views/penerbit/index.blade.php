@extends('main')

@section('title', 'Data Penerbit')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-building me-2"></i>Data Penerbit</h5>
        <a href="{{ route('penerbit.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Penerbit
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penerbits as $penerbit)
                    <tr>
                        <td>{{ $penerbit->idPenerbit }}</td>
                        <td>{{ $penerbit->nama }}</td>
                        <td>{{ $penerbit->alamat ?? '-' }}</td>
                        <td>{{ $penerbit->no_telp ?? '-' }}</td>
                        <td>{{ $penerbit->email ?? '-' }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('penerbit.edit', $penerbit->idPenerbit) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('penerbit.destroy', $penerbit->idPenerbit) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm show_confirm" data-nama="Penerbit {{ $penerbit->nama }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada data penerbit</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $penerbits->links() }}
        </div>
    </div>
</div>
@endsection