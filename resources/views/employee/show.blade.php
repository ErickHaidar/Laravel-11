@extends('master') 

@section('content')
<div class="card shadow-sm">
    {{-- Card Header --}}
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Detail Pegawai</h5>
        {{-- Tombol Kembali dan Edit --}}
        <div>
            <!-- <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-primary btn-sm">Edit</a> -->
            <a href="{{ route('employees.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </div>
    </div>

    {{-- Card Body --}}
    <div class="card-body">
        <p>
            <strong>Nama Lengkap:</strong><br>
            {{ $employee->nama_lengkap }}
        </p>
        
        <p>
            <strong>Email:</strong><br>
            {{ $employee->email }}
        </p>

        <p>
            <strong>Nomor Telepon:</strong><br>
            {{ $employee->nomor_telepon }}
        </p>

        <p>
            <strong>Tanggal Lahir:</strong><br>
            {{ \Carbon\Carbon::parse($employee->tanggal_lahir)->format('d F Y') }}
        </p>

        <p>
            <strong>Alamat:</strong><br>
            {{ $employee->alamat }}
        </p>

        <hr>

        {{-- =================================== --}}
        {{-- FIELD BARU DITAMBAHKAN DI SINI --}}
        {{-- =================================== --}}
        <p>
            <strong>Departemen:</strong><br>
            {{-- Pastikan relasi 'department' ada dan nama kolomnya benar --}}
            {{ $employee->department->nama_departemen ?? 'N/A' }}
        </p>

        <p>
            <strong>Jabatan:</strong><br>
            {{-- Pastikan relasi 'position' ada dan nama kolomnya benar --}}
            {{ $employee->position->nama_jabatan ?? 'N/A' }}
        </p>

        <p>
            <strong>Tanggal Masuk:</strong><br>
            {{ \Carbon\Carbon::parse($employee->tanggal_masuk)->format('d F Y') }}
        </p>

        <p>
            <strong>Status:</strong><br>
            {{-- Menggunakan 'badge' (lencana) agar status lebih jelas --}}
            @if($employee->status == 'aktif')
                <span class="badge bg-success text-capitalize">{{ $employee->status }}</span>
            @else
                <span class="badge bg-danger text-capitalize">{{ $employee->status }}</span>
            @endif
        </p>
    </div>
</div>
@endsection