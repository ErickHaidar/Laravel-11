@extends('master')

@section('content')
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Data Pegawai</h5>
        <a href="{{ route('employees.create') }}" class="btn btn-primary btn-sm">
            + Tambah Pegawai
        </a>
    </div>
    <div class="card-body">
        
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Lengkap</th>
                        <th scope="col">Email</th>
                        <th scope="col">Departemen</th>
                        <th scope="col">Jabatan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employees as $index => $emp)
                        <tr>
                            <th scope="row">{{ $index + $employees->firstItem() }}</th>
                            <td>{{ $emp->nama_lengkap }}</td>
                            <td>{{ $emp->email }}</td>
                            <td>{{ $emp->department->nama_departemen ?? 'N/A' }}</td>
                            <td>{{ $emp->position->nama_jabatan ?? 'N/A' }}</td>
                            <td>
                                @if($emp->status == 'aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Non-Aktif</span>
                                @endif
                            </td>
                            <td>
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" 
                                      action="{{ route('employees.destroy', $emp->id) }}" method="POST">
                                    
                                    <a href="{{ route('employees.show', $emp->id) }}" class="btn btn-info btn-sm">SHOW</a>
                                    <a href="{{ route('employees.edit', $emp->id) }}" class="btn btn-warning btn-sm">EDIT</a>
                                    
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">HAPUS</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                <div class="alert alert-danger">
                                    Data pegawai belum tersedia.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{ $employees->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection