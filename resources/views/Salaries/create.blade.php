@extends('master')

@section('content')
<div class="card shadow-sm">
    <div class="card-header">
        <h5 class="mb-0">Tambah Data Gaji</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('salaries.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="karyawan_id" class="form-label">Nama Karyawan</label>
                <select class="form-select @error('karyawan_id') is-invalid @enderror" 
                        id="karyawan_id" name="karyawan_id" required>
                    <option value="" data-gaji="0" disabled selected>-- Pilih Karyawan --</option>
                    @foreach ($employees as $emp)
                        <option value="{{ $emp->id }}" 
                                data-gaji="{{ $emp->position->gaji_pokok ?? 0 }}"
                                {{ old('karyawan_id') == $emp->id ? 'selected' : '' }}>
                            {{ $emp->nama_lengkap }} (Jabatan: {{ $emp->position->nama_jabatan ?? 'N/A' }})
                        </option>
                    @endforeach
                </select>
                @error('karyawan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="bulan" class="form-label">Bulan (Tahun-Bulan)</label>
                        <input type="month" class="form-control @error('bulan') is-invalid @enderror" 
                               id="bulan" name="bulan" value="{{ old('bulan') }}" required>
                        @error('bulan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="mb-3">
                        <label for="gaji_pokok" class="form-label">Gaji Pokok</label>
                        <input type="number" class="form-control @error('gaji_pokok') is-invalid @enderror" 
                               id="gaji_pokok" name="gaji_pokok" value="{{ old('gaji_pokok') }}" required readonly>
                        <small>Gaji pokok diambil otomatis dari jabatan karyawan.</small>
                        @error('gaji_pokok')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tunjangan" class="form-label">Tunjangan</label>
                        <input type="number" class="form-control @error('tunjangan') is-invalid @enderror" 
                               id="tunjangan" name="tunjangan" value="{{ old('tunjangan', 0) }}">
                        @error('tunjangan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="potongan" class="form-label">Potongan</label>
                        <input type="number" class="form-control @error('potongan') is-invalid @enderror" 
                               id="potongan" name="potongan" value="{{ old('potongan', 0) }}">
                        @error('potongan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <a href="{{ route('salaries.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('karyawan_id').addEventListener('change', function() {
        // Ambil gaji dari atribut data-gaji
        var selectedGaji = this.options[this.selectedIndex].getAttribute('data-gaji');
        // Masukkan ke field gaji_pokok
        document.getElementById('gaji_pokok').value = selectedGaji;
    });
</script>
@endsection