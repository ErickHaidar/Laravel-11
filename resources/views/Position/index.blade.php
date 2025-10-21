@extends('master')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Jabatan</h5>
            <a href="{{ route('positions.create') }}" class="btn btn-primary btn-sm">
                + Tambah Jabatan
            </a>
        </div>
        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" style="width: 5%;">#</th>
                            <th scope="col">Nama Jabatan</th>
                            <th scope="col">Gaji Pokok</th>
                            <th scope="col" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($positions as $index => $pos)
                            <tr>
                                <th scope="row">{{ $index + $positions->firstItem() }}</th>
                                <td>{{ $pos->nama_jabatan }}</td>
                                <td>Rp {{ number_format($pos->gaji_pokok, 0, ',', '.') }}</td>
                                <td>
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ route('positions.destroy', $pos->id) }}" method="POST">

                                        <a href="{{ route('positions.show', $pos->id) }}" class="btn btn-info btn-sm">SHOW</a>

                                        <a href="{{ route('positions.edit', $pos->id) }}"
                                            class="btn btn-warning btn-sm">EDIT</a>

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">
                                    <div class="alert alert-danger">
                                        Data jabatan belum tersedia.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $positions->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection