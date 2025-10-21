@extends('master')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Departemen</h5>
        <a href="{{ route('departments.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
    <div class="card-body">
        <h5 class="card-title mb-3">{{ $department->nama_departemen }}</h5>
        
        <hr>
        <h6>Pegawai di Departemen Ini:</h6>
        
        @if($department->employees->count() > 0)
            <ul class="list-group list-group-flush">
                @foreach($department->employees as $employee)
                    <li class="list-group-item">
                        {{ $employee->nama_lengkap }} ({{ $employee->email }})
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-muted">Belum ada pegawai di departemen ini.</p>
        @endif
        
    </div>
</div>
@endsection