@extends('layouts.main')

@section('content')
<main>
    <div class="container">
        <h1 class="mt-4">Ruang Kelas</h1>
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
                            <a href="{{ route('class-room.create') }}" class="btn btn-md btn-success">Tambah Ruang Kelas</a>
                            {{-- <div class="col-4"></div>
                            <form action="{{ route('class-room.search') }}" method="GET" class="input-group col">
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
                                <th>Kode Kelas</th>
                                <th>Kelas</th>  
                                <th>Kapasitas</th>                     
                            </tr>
                            @forelse ($classRoom as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah anda yakin ?');"
                                        action="{{ route('class-room.destroy', $row->id) }}" method="POST">
                                        <a href="{{ route('class-room.edit', $row->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil-fill"></i></a>
                                            @csrf
                                            @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash3-fill"></i></button>
                                    </form>

                                </td>
                                <td>{{ $row->class_code }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->capacity }}</td>
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