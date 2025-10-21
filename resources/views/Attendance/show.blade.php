@extends('master')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Absensi</h5>
            <a href="{{ route('attendances.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
        <div class="card-body">
            <p><strong>Karyawan:</strong><br>{{ $attendance->employee->nama_lengkap ?? 'N/A' }}</M>
            <p><strong>Tanggal:</strong><br>{{ \Carbon\Carbon::parse($attendance->tanggal)->format('d F Y') }}</p>
            <hr>
            <p><strong>Status Absensi:</strong><br>
                <span class="text-capitalize fw-bold">{{ $attendance->status_absensi }}</span>
            </p>
            <p><strong>Waktu Masuk:</strong><br>{{ $attendance->waktu_masuk ?? '-' }}</p>
            <p><strong>Waktu Keluar:</strong><br>{{ $attendance->waktu_keluar ?? '-' }}</p>
        </div>
    </div>
@endsection