@extends('layouts.main')

@section('content')
<main>
    <div class="container">
        
        <h1 class="mt-4">Data Pengguna</h1>
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
                            <a href="{{ route('user.create') }}" class="btn btn-md btn-success">Tambah Akun Pengguna</a>
                            {{-- <div class="col-4"></div>
                            <form action="{{ route('user.search') }}" method="GET" class="input-group col">
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
                                <th>Nama Pengguna</th>
                                <th>Kode Pengguna</th>
                                <th>Role</th>
                            </tr>
                            @forelse ($user as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah anda yakin ?');"
                                        action="{{ route('user.destroy', $row->id) }}" method="POST">
                                        <a href="{{ route('user.edit', $row->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil-fill"></i></a>
                                            @csrf
                                            @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash3-fill"></i></button>
                                    </form>

                                </td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->user_code }}</td>
                                <td>{{ $row->role }}</td>
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