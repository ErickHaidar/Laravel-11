@extends('master')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Gaji Karyawan</h5>
            <a href="{{ route('salaries.create') }}" class="btn btn-primary btn-sm">
                + Tambah Data Gaji
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
                            <th scope="col">Nama Karyawan</th>
                            <th scope="col">Bulan</th>
                            <th scope="col">Gaji Pokok</th>
                            <th scope="col">Tunjangan</th>
                            <th scope="col">Potongan</th>
                            <th scope="col">Total Gaji</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($salaries as $index => $salary)
                            <tr>
                                <th scope="row">{{ $index + $salaries->firstItem() }}</th>
                                <td>{{ $salary->employee->nama_lengkap ?? 'N/A' }}</td>
                                <td>{{ $salary->bulan }}</td>
                                <td>Rp {{ number_format($salary->gaji_pokok, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($salary->tunjangan, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($salary->potongan, 0, ',', '.') }}</td>
                                <td><strong>Rp {{ number_format($salary->total_gaji, 0, ',', '.') }}</strong></td>
                                <td>
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ route('salaries.destroy', $salary->id) }}" method="POST">

                                        <a href="{{ route('salaries.show', $salary->id) }}" class="btn btn-info btn-sm">SHOW</a>

                                        <a href="{{ route('salaries.edit', $salary->id) }}"
                                            class="btn btn-warning btn-sm">EDIT</a>

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    <div class="alert alert-danger">
                                        Data gaji belum tersedia.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $salaries->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection