@extends('master')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Tambah Data Absensi</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('attendances.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="karyawan_id" class="form-label">Nama Karyawan</label>
                <select class="form-select @error('karyawan_id') is-invalid @enderror" 
                        id="karyawan_id" name="karyawan_id" required>
                    <option value="" disabled selected>-- Pilih Karyawan --</option>
                    @foreach ($employees as $emp)
                        <option value="{{ $emp->id }}" {{ old('karyawan_id') == $emp->id ? 'selected' : '' }}>
                            {{ $emp->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
                @error('karyawan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" 
                               id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                        @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="status_absensi" class="form-label">Status Absensi</label>
                        <select class="form-select @error('status_absensi') is-invalid @enderror" 
                                id="status_absensi" name="status_absensi" required>
                            <option value="" disabled selected>-- Pilih Status --</option>
                            <option value="hadir" {{ old('status_absensi') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="izin" {{ old('status_absensi') == 'izin' ? 'selected' : '' }}>Izin</option>
                            <option value="sakit" {{ old('status_absensi') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                            <option value="alpha" {{ old('status_absensi') == 'alpha' ? 'selected' : '' }}>Alpha</option>
                        </select>
                        @error('status_absensi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="waktu_masuk" class="form-label">Waktu Masuk (HH:MM)</label>
                        <input type="time" class="form-control @error('waktu_masuk') is-invalid @enderror" 
                               id="waktu_masuk" name="waktu_masuk" value="{{ old('waktu_masuk') }}">
                        @error('waktu_masuk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="waktu_keluar" class="form-label">Waktu Keluar (HH:MM)</label>
                        <input type="time" class="form-control @error('waktu_keluar') is-invalid @enderror" 
                               id="waktu_keluar" name="waktu_keluar" value="{{ old('waktu_keluar') }}">
                        @error('waktu_keluar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <a href="{{ route('attendances.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection