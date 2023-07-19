@extends('layouts.main')

@section('content')
<main>
    <div class="container">
        
        <h1 class="mt-4">Data Siswa</h1>
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
                        <div class="justify-content-between mb-3">
                            <a href="{{ route('student.create') }}" class="btn btn-md btn-success">Tambah Data Siswa</a>
                            {{-- <div class="col-4"></div>
                            <form action="{{ route('student.search') }}" method="GET" class="input-group col">
                                @csrf
                                <input type="text" class="form-control" placeholder="Pencarian . . ."
                                    name="search" value="{{ old('search') }}">
                                <button class="btn btn-outline-secondary" type="submit">Cari</button>
                            </form>  --}}
                        </div>                
                        <table class="table table-bordered mt-1">
                            <tr>
                                <th>#</th>
                                <th>Aksi</th>
                                <th>NIS</th>
                                <th>Nama Siswa</th>
                                <th>Tempat & Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Orang Tua</th>
                                <th>Telepon</th>  
                                <th>E-Mail</th>                          
                            </tr>
                            @forelse ($student as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah anda yakin ?');"
                                        action="{{ route('student.destroy', $row->id) }}" method="POST">
                                        <a href="{{ route('student.settings', $row->student_code) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-gear-fill"></i></a>
                                        <a href="{{ route('student.edit', $row->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil-fill"></i></a>
                                            @csrf
                                            @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash3-fill"></i></button>
                                    </form>

                                </td>
                                <td>{{ $row->student_code }}</td>
                                <td>{{ $row->name.$row->gender }}</td>
                                <td>{{ $row->place_of_birth.", ".$row->date_of_birth }}</td>
                                <td>{{ $row->address }}</td>
                                <td>{{ $row->parent_name }}</td>
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