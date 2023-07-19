@extends('layouts.main')

@section('content')
<main>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">

                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('course.store') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="course_code">Kode Mata Pelajaran</label>
                                <input type="text" class="form-control @error('course_code') is-invalid @enderror"
                                    name="course_code" value="{{ old('course_code') }}">
                                @error('course_code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Mata Pelajaran</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Deskripsi</label>
                                <input type="description" class="form-control @error('description') is-invalid @enderror"
                                    name="description" value="{{ old('description') }}">
                                @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>   

                            <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                            <a href="{{ route('course.index') }}" class="btn btn-md btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </>
        </div>
    </div>
</main>
@endsection