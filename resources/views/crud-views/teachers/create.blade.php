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
                        <form action="{{ route('teacher.store') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="teacher_code">Nomor Induk Guru</label>
                                <input type="text" class="form-control @error('teacher_code') is-invalid @enderror"
                                    name="teacher_code" value="{{ old('teacher_code') }}">
                                @error('teacher_code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Nama Guru</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="gender">Jenis Kelamin</label>
                                <input type="text" class="form-control @error('gender') is-invalid @enderror"
                                    name="gender" value="{{ old('gender') }}">
                                @error('gender')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="place_of_birth">Tempat Lahir</label>
                                <input type="place_of_birth" class="form-control @error('place_of_birth') is-invalid @enderror"
                                    name="place_of_birth" value="{{ old('place_of_birth') }}">
                                @error('place_of_birth')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>   
                            <div class="form-group mb-3">
                                <label for="date_of_birth">Tanggal Lahir</label>
                                <input type="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror"
                                    name="date_of_birth" value="{{ old('date_of_birth') }}">
                                @error('date_of_birth')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div> 
                            <div class="form-group mb-3">
                                <label for="contact_number">Telepon</label>
                                <input type="text" class="form-control @error('contact_number') is-invalid @enderror"
                                    name="contact_number" value="{{ old('contact_number') }}">
                                @error('contact_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">E-Mail</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="address">Alamat</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    name="address" value="{{ old('address') }}">
                                @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                            <a href="{{ route('teacher.index') }}" class="btn btn-md btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </>
        </div>
    </div>
</main>
@endsection