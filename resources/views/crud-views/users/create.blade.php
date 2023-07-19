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
                        <form action="{{ route('user.store') }}" method="POST">
                            @csrf
                            
                            <div class="form-group mb-3">
                                <label for="name">Nama Pengguna</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="user_code">Kode Pengguna</label>
                                <input type="text" class="form-control @error('user_code') is-invalid @enderror"
                                    name="user_code" value="{{ old('user_code') }}">
                                @error('user_code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="role">Role</label>
                                <input type="text" class="form-control @error('role') is-invalid @enderror"
                                    name="role" value="{{ old('role') }}">
                                @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>   
                            <div class="form-group mb-3">
                                <label for="username">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    name="username" value="{{ old('username') }}">
                                @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>   
                            <div class="form-group mb-3">
                                <label for="password">Password</label>
                                <input type="text" class="form-control @error('password') is-invalid @enderror"
                                    name="password" value="{{ old('password') }}">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>   

                            <button type="submit" class="btn btn-md btn-primary">Simpan</button>
                            <a href="{{ route('user.index') }}" class="btn btn-md btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </>
        </div>
    </div>
</main>
@endsection