@extends('layouts.main')

@section('content')
<main>
    <div class="container">
        <h1 class="mt-4">Semester</h1>
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
                        <div class="justify-content-start mb-3">

                            @php if (request()->route()->getName() === 'semester.create') { @endphp
                                <form action="{{ route('semester.store') }}" method="POST" class="form-controll row">
                                    @csrf
                                    <label for="semester_type" class="text-start col">Semester</label>
                                    <select name="semester_type" class="form-select col @error('semester_type') is-invalid @enderror">
                                        <option value="-" disabled selected>-</option>  
                                        <option value="Ganjil">Ganjil</option>    
                                        <option value="Genap">Genap</option>
                                        @error('semester_type') <div class="invalid-feedback">
                                            {{ $message }} </div> @enderror  
                                    </select>
                                    <label for="academic_year_1" class="col">20</label>
                                    <input type="number" class="form-control col @error('academic_year_1') is-invalid @enderror"
                                        min="00" max="99" inputmode="numeric" pattern="[0-9]*"
                                        name="academic_year_1" value="{{ old('academic_year_1', '00') }}">
                                        @error('academic_year_1') <div class="invalid-feedback">
                                            {{ $message }} </div> @enderror
                                    <label for="academic_year_2" class="col">/ 20</label>
                                    <input type="number" class="form-control col @error('academic_year_2') is-invalid @enderror"
                                        min="00" max="99" inputmode="numeric" pattern="[0-9]*"
                                        name="academic_year_2" value="{{ old('academic_year_2', '00') }}">
                                        @error('academic_year_2') <div class="invalid-feedback">
                                            {{ $message }} </div> @enderror
                                    <button class="btn btn-md btn-success col" type="submit">Tambah</button>
                                    <a href="{{ route('semester.index') }}" class="btn btn-md btn-secondary col">Batal</a>
                                </form> 
                            @php } else { @endphp
                                <a href="{{ route('semester.create') }}" class="btn btn-md btn-success">Tambah Semester</a>
                            @php } @endphp


                        </div>                
                        <table class="table table-bordered mt-1">
                            <tr >
                                <th>#</th>
                                <th>Aksi</th>
                                <th style="width: 80%">Semester</th>              
                            </tr>
                            @forelse ($semester as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah anda yakin ?');"
                                        action="{{ route('semester.destroy', $row->id) }}" method="POST">
                                        <a href="{{ route('semester.edit', $row->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil-fill"></i></a>
                                            @csrf
                                            @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash3-fill"></i></button>
                                    </form>

                                </td>
                                <td>
                                    @php if (request()->route()->getName() === 'semester.edit' && request()->route('id') == $row->id) { @endphp
                                        <form action="{{ route('semester.update', $row->id) }}" method="POST" class="input-group">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group row">
                                                <select name="semester_type" class="form-select col @error('semester_type') is-invalid @enderror">
                                                    <option value="-" disabled>-</option>  
                                                    <option value="Ganjil" {{ $row->semester_type === 'Ganjil'? 'selected' : '' }}>Ganjil</option>    
                                                    <option value="Genap" {{ $row->semester_type === 'Genap'? 'selected' : '' }}>Genap</option>
                                                    @error('semester_type') <div class="invalid-feedback">
                                                        {{ $message }} </div> @enderror  
                                                </select>
                                                <input type="text" class="form-control col @error('academic_year') is-invalid @enderror"
                                                    name="academic_year" value="{{ old('academic_year', $semesterId->academic_year) }}">
                                                @error('academic_year')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <button class="btn btn-md btn-success" type="submit">Simpan</button>
                                            <a href="{{ route('semester.index') }}" class="btn btn-md btn-secondary">Batal</a>
                                        </form> 
                                    @php } else { @endphp
                                        {{ $row->semester_type.' '.$row->academic_year }}
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