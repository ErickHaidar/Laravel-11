@extends('master')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Absensi</h5>
            <a href="{{ route('attendances.create') }}" class="btn btn-primary btn-sm">
                + Tambah Data Absensi
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
                            <th scope="col">Tanggal</th>
                            <th scope="col">Waktu Masuk</th>
                            <th scope="col">Waktu Keluar</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attendances as $index => $att)
                            <tr>
                                <th scope="row">{{ $index + $attendances->firstItem() }}</th>
                                <td>{{ $att->employee->nama_lengkap ?? 'Karyawan Dihapus' }}</td>
                                <td>{{ $att->tanggal }}</td>
                                <td>{{ $att->waktu_masuk ?? '-' }}</td>
                                <td>{{ $att->waktu_keluar ?? '-' }}</td>
                                <td>
                                    @if($att->status_absensi == 'hadir')
                                        <span class="badge bg-success text-capitalize">{{ $att->status_absensi }}</span>
                                    @elseif($att->status_absensi == 'sakit' || $att->status_absensi == 'izin')
                                        <span class="badge bg-warning text-capitalize">{{ $att->status_absensi }}</span>
                                    @else
                                        <span class="badge bg-danger text-capitalize">{{ $att->status_absensi }}</span>
                                    @endif
                                </td>
                                <td>
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ route('attendances.destroy', $att->id) }}" method="POST">

                                        <a href="{{ route('attendances.show', $att->id) }}" class="btn btn-info btn-sm">SHOW</a>

                                        <a href="{{ route('attendances.edit', $att->id) }}"
                                            class="btn btn-warning btn-sm">EDIT</a>

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
                                        Data absensi belum tersedia.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $attendances->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection