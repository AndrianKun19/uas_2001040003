@extends('layouts.main')

@section('content')
<main>
    <div class="container">
        <h1 class="mt-4">Daftar siswa</h1>
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
                        <div class="row justify-content mb-3">
                            <a href="{{ route('enrollment.create', request()->route('id')) }}" class="btn btn-md btn-success col-2
                                @if (request()->route('id') === '-') disabled @endif">
                                Tambah Ruang Kelas 
                            </a>
                            <div class="col-4"></div>
                            {{-- <form id="semesterForm" action="{{ route('enrollment.index', ) }}" method="GET">
                                @csrf
                                <select name="semester" class="form-select col" onchange="event.preventDefault(); document.getElementById('semesterForm').submit()">
                                    
                                    @foreach ($semester as $row)
                                    <option value="{{ $row->id }}" {{ $row->active? 'selected' : '' }}>
                                        {{ $row->semester_type.' '.$row->academic_year }}
                                    </option>
                                    @endforeach
                                </select>
                            </form>    --}}
        <ul class="form-select col">
            @foreach ($semester as $row)
                <li class="list-group-item">
                    <a href="{{ route('enrollment.index', $row->id) }}">{{ $row->semester_type.' '.$row->academic_year }}</a>
                </li>
            @endforeach
        </ul>
                            
                        </div>                
                        <table class="table table-bordered mt-1">
                            <tr>
                                <th>#</th>
                                <th>Aksi</th>
                                <th>Kelas</th>  
                                <th>Wali kelas</th>
                                <th>Jumlah siswa</th>                     
                            </tr>
                            @forelse ($enrollment as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    {{-- <form onsubmit="return confirm('Apakah anda yakin ?');"
                                        action="{{ route('enrollment.destroy', $row->id) }}" method="POST">
                                        <a href="{{ route('enrollment.edit', $row->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil-fill"></i></a>
                                            @csrf
                                            @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash3-fill"></i></button>
                                    </form> --}}
                                    {{ $row->levelSemester->level->level }}
                                    {{ $row->levelSemester->semester->semester_type.' '.$row->levelSemester->semester->academic_year }}
                                </td>
                                <td>{{ $row->teacher->name }}</td>
                                <td>{{ $row->classRoom->name }}</td>
                                <td>{{ $row->total_students }}</td>
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