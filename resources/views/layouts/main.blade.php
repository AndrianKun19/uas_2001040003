<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> --}}
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"> --}}
    <title>Dashboard</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{ request()->route()->getName() }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('student.index') }}">Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('teacher.index') }}">Teachers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('course.index') }}">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('class-room.index') }}">Class Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('level.index') }}">Levels</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('semester.index') }}">Semesters</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('enrollment.index', '-') }}">Enrollments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.index') }}">Users</a>
                    </li>
                </ul>
            </div>
            @php if (Auth::check()) { @endphp
            <form onsubmit="return confirm('Apakah anda yakin ingin keluar?');"
                action="{{ route('logout') }}" method="GET">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger">
                    Logout</button>
            </form>
            @php } @endphp
        </div>
      </nav>
    @yield('content')
    
      
    
</body>
</html>