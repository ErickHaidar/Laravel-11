@extends('master')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Departemen</h5>
            <a href="{{ route('departments.create') }}" class="btn btn-primary btn-sm">
                + Tambah Departemen
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
                            <th scope="col">Nama Departemen</th>
                            <th scope="col" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($departments as $index => $dept)
                            <tr>
                                <th scope="row">{{ $index + $departments->firstItem() }}</th>
                                <td>{{ $dept->nama_departemen }}</td>
                                <td>
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ route('departments.destroy', $dept->id) }}" method="POST">

                                        <a href="{{ route('departments.show', $dept->id) }}"
                                            class="btn btn-info btn-sm">SHOW</a>

                                        <a href="{{ route('departments.edit', $dept->id) }}"
                                            class="btn btn-warning btn-sm">EDIT</a>

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">
                                    <div class="alert alert-danger">
                                        Data departemen belum tersedia.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $departments->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection