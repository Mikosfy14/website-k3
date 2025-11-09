<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - {{ config('app.name', 'Website K3') }}</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="d-flex">
    <!-- Sidebar -->
    <div class="bg-light sidebar d-flex flex-column p-3" style="width: 250px; height: 100vh; position: fixed;">
        <h4 class="text-center mb-4">Admin Panel</h4>
        <nav class="nav flex-column">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a class="nav-link" href="{{ route('gedung.index') }}">Kelola Gedung</a>
            <a class="nav-link" href="{{ route('jalur-mitigasi.index') }}">Kelola Jalur Mitigasi</a>
            <a class="nav-link" href="{{ route('lantai.index') }}">Kelola Lantai</a>
            <a class="nav-link" href="{{ route('ruangan.index') }}">Kelola Ruangan</a>
        </nav>
        <hr class="my-4">
        <form method="POST" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-link nav-link text-danger">Logout</button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1 ms-3 p-3" style="margin-left: 250px;">
        <nav class="navbar navbar-light bg-light mb-3">
            <span class="navbar-brand">Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}!</span>
        </nav>
        @yield('content')
    </div>
</body>
</html>