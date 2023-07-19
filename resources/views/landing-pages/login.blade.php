@extends('layouts.main')

@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

              @if(session('error'))
              <div class="alert alert-danger">
                  {{ session('error') }}
              </div>
              @endif

                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                      <form method="POST" action="{{ route('login') }}">
                          @csrf
  
                          <div class="row mb-3">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control @error('username') 
                              is-invalid @enderror" name="username" value="{{ old('username') }}">
                              @error('username')
                              <div class="invalid-feedback">
                                  {{ $message }}
                              </div>
                              @enderror
                            </div>
                          </div>
                        
                          <div class="row mb-3">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control @error('password') 
                              is-invalid @enderror" name="password">
                              @error('password')
                              <div class="invalid-feedback">
                                  {{ $message }}
                              </div>
                              @enderror
                            </div>
                          </div>
  
                          <button type="submit" class="btn btn-primary">Sign in</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
@endsection