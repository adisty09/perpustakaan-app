@extends('main')

@section('title', 'Peminjaman Baru')

@section('content')
<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Form Peminjaman Buku</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('peminjaman.store') }}" method="POST" id="formPeminjaman">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">ID Peminjaman</label>
                                <input type="text" name="idPeminjaman" class="form-control" value="{{ $newId }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Pinjam</label>
                                <input type="text" class="form-control" value="{{ date('d/m/Y') }}" readonly>
                                <small class="text-muted">Masa pinjam: 7 hari</small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Anggota</label>
                        <select name="idAnggota" class="form-select" required>
                            <option value="">Pilih Anggota</option>
                            @foreach($anggotas as $anggota)
                                <option value="{{ $anggota->idAnggota }}">{{ $anggota->idAnggota }} - {{ $anggota->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Petugas Pustakawan</label>
                        <select name="idPustakawan" class="form-select" required>
                            <option value="">Pilih Petugas</option>
                            @foreach($pustakawans as $pustakawan)
                                <option value="{{ $pustakawan->idPustakawan }}">{{ $pustakawan->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <hr>
                    <h6 class="fw-bold">Daftar Buku</h6>
                    <div id="bukuList">
                        <div class="row buku-item mb-2">
                            <div class="col-md-10">
                                <select name="bukus[]" class="form-select" required>
                                    <option value="">Pilih Buku</option>
                                    @foreach($bukus as $buku)
                                        <option value="{{ $buku->idBuku }}">{{ $buku->judul }} (Stok: {{ $buku->stok_tersedia }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger btn-sm hapusBuku" style="display: none;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="tambahBuku">
                        <i class="bi bi-plus-circle"></i> Tambah Buku
                    </button>
                    
                    <hr>
                    <div class="d-flex gap-2">
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Peminjaman</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#tambahBuku').click(function() {
        var newRow = $('.buku-item:first').clone();
        newRow.find('select').val('');
        newRow.find('.hapusBuku').show();
        $('#bukuList').append(newRow);
    });
    
    $(document).on('click', '.hapusBuku', function() {
        $(this).closest('.buku-item').remove();
    });
</script>
@endpush