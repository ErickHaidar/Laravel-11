@extends('master')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Jabatan</h5>
        <a href="{{ route('positions.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
    <div class="card-body">
        <h5 class="card-title">{{ $position->nama_jabatan }}</h5>
        <p class="card-text">
            <strong>Gaji Pokok:</strong> Rp {{ number_format($position->gaji_pokok, 0, ',', '.') }}
        </p>
        
        <hr>
        <h6>Pegawai dengan Jabatan Ini:</h6>
        
        @if($position->employees->count() > 0)
            <ul class="list-group list-group-flush">
                @foreach($position->employees as $employee)
                    <li class="list-group-item">
                        {{ $employee->nama_lengkap }} ({{ $employee->email }})
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-muted">Belum ada pegawai dengan jabatan ini.</p>
        @endif
    </div>
</div>
@endsection