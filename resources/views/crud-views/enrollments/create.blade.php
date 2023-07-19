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
                        <form action="{{ route('enrollment.store') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="class_code">Kode Kelas</label>
                                <input type="text" class="form-control @error('class_code') is-invalid @enderror"
                                    name="class_code" value="{{ old('class_code') }}">
                                @error('class_code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Nama Kelas</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="capacity">Kapasitas</label>
                                <input type="text" class="form-control @error('capacity') is-invalid @enderror"
                                    name="capacity" value="{{ old('capacity') }}">
                                @error('capacity')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>   

                            <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                            <a href="{{ route('class-room.index') }}" class="btn btn-md btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </>
        </div>
    </div>
</main>
@endsection