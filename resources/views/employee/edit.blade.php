@extends('master')

@section('content')
<div class="card shadow-sm">
    {{-- Card Header --}}
    <div class="card-header">
        <h5 class="mb-0">Edit Data Pegawai</h5>
    </div>

    {{-- Card Body --}}
    <div class="card-body">

        {{-- =================================== --}}
        {{-- BAGIAN 1: TAMPILKAN ERROR VALIDASI --}}
        {{-- =================================== --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops! Terjadi kesalahan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama Lengkap --}}
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" 
                       value="{{ old('nama_lengkap', $employee->nama_lengkap) }}">
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" 
                       value="{{ old('email', $employee->email) }}">
            </div>

            {{-- Nomor Telepon --}}
            <div class="mb-3">
                <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" 
                       value="{{ old('nomor_telepon', $employee->nomor_telepon) }}">
            </div>

            {{-- Tanggal Lahir --}}
            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" 
                       value="{{ old('tanggal_lahir', $employee->tanggal_lahir) }}">
            </div>

            {{-- Alamat --}}
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" 
                       value="{{ old('alamat', $employee->alamat) }}">
            </div>

            {{-- Tanggal Masuk --}}
            <div class="mb-3">
                <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" 
                       value="{{ old('tanggal_masuk', $employee->tanggal_masuk) }}">
            </div>

            {{-- =========================================== --}}
            {{-- BAGIAN 2: TAMBAHKAN DROPDOWN DEPARTEMEN --}}
            {{-- =========================================== --}}
            <div class="mb-3">
                <label for="departemen_id" class="form-label">Departemen</label>
                <select class="form-select" id="departemen_id" name="departemen_id">
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ old('departemen_id', $employee->departemen_id) == $department->id ? 'selected' : '' }}>
                            {{ $department->nama_departemen }} {{-- Asumsi namanya 'nama_departemen' --}}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- =========================================== --}}
            {{-- BAGIAN 2: TAMBAHKAN DROPDOWN JABATAN --}}
            {{-- =========================================== --}}
            <div class="mb-3">
                <label for="jabatan_id" class="form-label">Jabatan</label>
                <select class="form-select" id="jabatan_id" name="jabatan_id">
                    @foreach($positions as $position)
                        <option value="{{ $position->id }}" {{ old('jabatan_id', $employee->jabatan_id) == $position->id ? 'selected' : '' }}>
                            {{ $position->nama_jabatan }} {{-- Asumsi namanya 'nama_jabatan' --}}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- =================================== --}}
            {{-- BAGIAN 3: PERBAIKI VALUE STATUS --}}
            {{-- =================================== --}}
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="aktif" {{ old('status', $employee->status) == 'aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="non-aktif" {{ old('status', $employee->status) == 'non-aktif' ? 'selected' : '' }}>
                        Non-Aktif
                    </option>
                </select>
            </div>

            {{-- Tombol --}}
            <hr>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-secondary">Batal</a>
            
        </form>
    </div>
</div>
@endsection