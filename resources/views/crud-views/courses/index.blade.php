@extends('layouts.main')

@section('content')
<main>
    <div class="container">
        <h1 class="mt-4">Mata Pelajaran</h1>
        <div class="row">
            <div class="col-md-12">

                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
                @endif

                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('course.create') }}" class="btn btn-md btn-success mb-3 float-right">Tambah Mata Pelajaran</a>
                        <table class="table table-bordered mt-1">
                            <tr>
                                <th>#</th>
                                <th>Aksi</th>
                                <th>Kode Mapel</th>
                                <th>Mata Pelajaran</th>
                                <th>Deskripsi</th>                  
                            </tr>
                            @forelse ($course as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah anda yakin ?');"
                                        action="{{ route('course.destroy', $row->id) }}" method="POST">
                                        <a href="{{ route('course.edit', $row->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil-fill"></i></a>
                                            @csrf
                                            @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash3-fill"></i></button>
                                    </form>

                                </td>
                                <td>{{ $row->course_code }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->description }}</td>
                            </tr>

                            @empty
                            <tr>
                                <td class="text-center text-mute" colspan="4">Data tidak tersedia</td>
                            </tr>

                            @endforelse

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection