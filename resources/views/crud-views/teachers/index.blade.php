@extends('layouts.main')

@section('content')
<main>
    <div class="container">
        <h1 class="mt-4">Data Guru</h1>
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
                        <a href="{{ route('teacher.create') }}" class="btn btn-md btn-success mb-3 float-right">Tambah Data Guru</a>
                        <table class="table table-bordered mt-1">
                            <tr>
                                <th>#</th>
                                <th>Aksi</th>
                                <th>NIP</th>
                                <th>Nama Guru</th>
                                <th>Tempat & Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Telepon</th>  
                                <th>E-Mail</th>                          
                            </tr>
                            @forelse ($teacher as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah anda yakin ?');"
                                        action="{{ route('teacher.destroy', $row->id) }}" method="POST">
                                        <a href="{{ route('teacher.settings', $row->teacher_code) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-gear-fill"></i></a>
                                        <a href="{{ route('teacher.edit', $row->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil-fill"></i></a>
                                            @csrf
                                            @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash3-fill"></i></button>
                                    </form>

                                </td>
                                <td>{{ $row->teacher_code }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->place_of_birth.", ".$row->date_of_birth }}</td>
                                <td>{{ $row->address }}</td>
                                <td>{{ $row->contact_number }}</td>
                                <td>{{ $row->email }}</td>
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