@extends('layouts.main')

@section('content')
<main>
    <div class="container">
        <h1 class="mt-4">Level</h1>
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

                            @php if (request()->route()->getName() === 'level.create') { @endphp
                                <form action="{{ route('level.store') }}" method="POST" class="input-group ">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="level" class="col-4">Level</label>
                                        <input type="number" class="form-control col @error('level') is-invalid @enderror"
                                            name="level" value="{{ old('level', 0) }}">
                                        @error('level')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <button class="btn btn-md btn-success" type="submit">Tambah</button>
                                    <a href="{{ route('level.index') }}" class="btn btn-md btn-secondary">Batal</a>
                                </form> 
                            @php } else { @endphp
                                <a href="{{ route('level.create') }}" class="btn btn-md btn-success">Tambah Level</a>
                            @php } @endphp


                        </div>                
                        <table class="table table-bordered mt-1">
                            <tr >
                                <th >#</th>
                                <th >Aksi</th>
                                <th style="width: 80%">Level</th>              
                            </tr>
                            @forelse ($level as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah anda yakin ?');"
                                        action="{{ route('level.destroy', $row->id) }}" method="POST">
                                        <a href="{{ route('level.edit', $row->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil-fill"></i></a>
                                            @csrf
                                            @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash3-fill"></i></button>
                                    </form>

                                </td>
                                <td>
                                    @php if (request()->route()->getName() === 'level.edit' && request()->route('id') == $row->id) { @endphp
                                        <form action="{{ route('level.update', $row->id) }}" method="POST" class="input-group">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group row">
                                                <input type="number" class="form-control col @error('level') is-invalid @enderror"
                                                    name="level" value="{{ old('level', $levelId->level) }}">
                                                @error('level')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <button class="btn btn-md btn-success" type="submit">Simpan</button>
                                            <a href="{{ route('level.index') }}" class="btn btn-md btn-secondary">Batal</a>
                                        </form> 
                                    @php } else { @endphp
                                        {{ $row->level }}
                                    @php } @endphp
                                </td>
                                
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