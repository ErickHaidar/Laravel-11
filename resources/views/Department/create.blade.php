@extends('master')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Tambah Departemen Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('departments.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nama_departemen" class="form-label">Nama Departemen</label>
                <input type="text" class="form-control @error('nama_departemen') is-invalid @enderror" 
                       id="nama_departemen" name="nama_departemen" value="{{ old('nama_departemen') }}" required>
                
                @error('nama_departemen')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <a href="{{ route('departments.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection