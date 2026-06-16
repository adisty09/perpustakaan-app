@extends('main')

@section('title', 'Manajemen User')

@section('content')
<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-shield-lock me-2"></i>Manajemen User</h5>
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah User
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge {{ $user->role == 'superadmin' ? 'bg-danger' : 'bg-primary' }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm show_confirm" data-nama="User {{ $user->name }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data user</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection

@section('footer')
    <p>Manajemen User - Dinas Kearsipan dan Perpustakaan Kota Palembang</p>
@endsection