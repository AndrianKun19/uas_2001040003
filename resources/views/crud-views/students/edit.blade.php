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
                        <form action="{{ route('student.update', $student->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="student_code">Nomor Induk Siswa</label>
                                <input type="text" class="form-control @error('student_code') is-invalid @enderror"
                                    name="student_code" value="{{ old('student_code', $student->student_code) }}" disabled>
                                @error('student_code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="name">Nama Siswa</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name', $student->name) }}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="place_of_birth">Tempat Lahir</label>
                                <input type="place_of_birth" class="form-control @error('place_of_birth') is-invalid @enderror"
                                    name="place_of_birth" value="{{ old('place_of_birth', $student->place_of_birth) }}">
                                @error('place_of_birth')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>   
                            <div class="form-group mb-3">
                                <label for="date_of_birth">Tanggal Lahir</label>
                                <input type="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror"
                                    name="date_of_birth" value="{{ old('date_of_birth', $student->date_of_birth) }}">
                                @error('date_of_birth')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div> 
                            <div class="form-group mb-3">
                                <label for="parent_name">Nama Orang Tua</label>
                                <input type="parent_name" class="form-control @error('parent_name') is-invalid @enderror"
                                    name="parent_name" value="{{ old('parent_name', $student->parent_name) }}">
                                @error('parent_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="contact_number">Telepon</label>
                                <input type="text" class="form-control @error('contact_number') is-invalid @enderror"
                                    name="contact_number" value="{{ old('contact_number', $student->contact_number) }}">
                                @error('contact_number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="email">E-Mail</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email', $student->email) }}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="address">Alamat</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    name="address" value="{{ old('address', $student->address) }}">
                                @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-md btn-primary mt-3 mr-3">Simpan</button>
                            <a href="{{ route('student.index') }}" class="btn btn-md btn-secondary mt-3">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection