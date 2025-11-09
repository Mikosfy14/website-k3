<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Sistem K3' }} - Website K3</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --color-primary: #003366;
            --color-secondary: #ffb300;
            --color-primary-dark: #002244;
            --color-primary-light: #004488;
        }

        .navbar-custom {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .btn-primary-custom {
            background: var(--color-primary);
            border-color: var(--color-primary);
            color: white;
        }

        .btn-primary-custom:hover {
            background: var(--color-primary-dark);
            border-color: var(--color-primary-dark);
        }

        .btn-secondary-custom {
            background: var(--color-secondary);
            border-color: var(--color-secondary);
            color: white;
        }

        .btn-secondary-custom:hover {
            background: #cc8f00;
            border-color: #cc8f00;
        }

        .footer-custom {
            background: var(--color-primary);
            color: white;
        }

        .text-primary-custom {
            color: var(--color-primary) !important;
        }

        .text-secondary-custom {
            color: var(--color-secondary) !important;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="me-2" viewBox="0 0 16 16" style="display: inline-block; vertical-align: text-bottom;">
                    <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.8 11.8 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7 7 0 0 0 1.048-.625 11.8 11.8 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.54 1.54 0 0 0-1.044-1.263 63 63 0 0 0-2.887-.87C9.843.266 8.69 0 8 0m0 5a1.5 1.5 0 0 1 .5 2.915l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99A1.5 1.5 0 0 1 8 5"/>
                </svg>
                Sistem K3
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('auth.login') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16" style="display: inline-block; vertical-align: text-bottom;">
                                <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z"/>
                                <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
                            </svg>
                            Admin Login
                        </a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="footer-custom mt-5 py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="fw-bold mb-3">Sistem Manajemen K3</h5>
                    <p class="mb-2">Keselamatan dan Kesehatan Kerja</p>
                    <p class="text-white-50 small">Sistem informasi untuk mengelola jalur evakuasi dan mitigasi bencana di lingkungan kerja.</p>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-bold mb-3">Menu</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('home') }}" class="text-white text-decoration-none">Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('login') }}" class="text-white text-decoration-none">Admin Login</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-bold mb-3">Informasi</h6>
                    <p class="mb-2 small">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="var(--color-secondary)" class="me-2" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.8 11.8 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7 7 0 0 0 1.048-.625 11.8 11.8 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.54 1.54 0 0 0-1.044-1.263 63 63 0 0 0-2.887-.87C9.843.266 8.69 0 8 0"/>
                        </svg>
                        Sistem K3 v1.0.0
                    </p>
                </div>
            </div>
            <hr class="my-4 bg-white opacity-25">
            <div class="text-center text-white-50 small">
                <p class="mb-0">&copy; {{ date('Y') }} Sistem Manajemen K3. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
