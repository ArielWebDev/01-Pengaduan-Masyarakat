<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Masyarakat Portal')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
        <!-- Navbar hanya muncul jika user sudah login -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="{{ route('masyarakat.dashboard') }}">Masyarakat</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('masyarakat.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('masyarakat.pengaduan.semua') }}">Pengaduan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('masyarakat.pengaduan.saya') }}">Pengaduan Saya</a>
                        </li>
                            @if(Auth::guard('masyarakat')->check())
                                <!-- Jika sudah login, tampilkan tombol Logout -->
                                <li class="nav-item">
                                    <form action="{{ route('masyarakat.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-link nav-link">Logout</button>
                                    </form>
                                </li>
                            @else
                                <!-- Jika belum login, tampilkan tombol Login & Register -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('masyarakat.login') }}">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('masyarakat.register') }}">Register</a>
                                </li>
                            @endif
                    </ul>
                </div>
            </div>
        </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
