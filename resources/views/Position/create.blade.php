@extends('master')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Tambah Jabatan Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('positions.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nama_jabatan" class="form-label">Nama Jabatan</label>
                <input type="text" class="form-control @error('nama_jabatan') is-invalid @enderror" 
                       id="nama_jabatan" name="nama_jabatan" value="{{ old('nama_jabatan') }}" required>
                @error('nama_jabatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                <input type="number" class="form-control @error('gaji_pokok') is-invalid @enderror" 
                       id="gaji_pokok" name="gaji_pokok" value="{{ old('gaji_pokok') }}" required min="0">
                @error('gaji_pokok')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <a href="{{ route('positions.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection