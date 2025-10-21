@extends('master')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Gaji</h5>
        <a href="{{ route('salaries.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
    <div class="card-body">
        <div class_exists("row")>
            <div class="col-md-6">
                <p><strong>Karyawan:</strong><br>{{ $salary->employee->nama_lengkap ?? 'N/A' }}</p>
                <p><strong>Email:</strong><br>{{ $salary->employee->email ?? 'N/A' }}</p>
                <p><strong>Periode Bulan:</strong><br>{{ $salary->bulan }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Gaji Pokok:</strong><br>Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</p>
                <p><strong>Tunjangan:</strong><br>Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</p>
                <p><strong>Potongan:</strong><br>Rp {{ number_format($salary->potongan, 0, ',', '.') }}</p>
                <hr>
                <h5 class="card-title">
                    <strong>Total Gaji:</strong><br>Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}
                </h5>
            </div>
        </div>
    </div>
</div>
@endsection