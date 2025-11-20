<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Sistem K3' }} - VokasiEvac -  </title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
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
            background: var(--color-primary-light);
            border-color: var(--color-primary-light);
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
        <a class="navbar-brand fw-bold d-flex align-items-center ps-3" href="{{ route('home') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.8 11.8 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7 7 0 0 0 1.048-.625 11.8 11.8 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.54 1.54 0 0 0-1.044-1.263 63 63 0 0 0-2.887-.87C9.843.266 8.69 0 8 0m0 5a1.5 1.5 0 0 1 .5 2.915l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99A1.5 .5 0 0 1 8 5"/>
            </svg>
            VokasiEvac
        </a>

        <div class="position-absolute end-0 top-50 translate-middle-y pe-3">
            <img src="{{ asset('images/Logo-FVUB.jpg') }}"
                 alt="Fakultas Vokasi Universitas Brawijaya"
                 class="img-fluid"
                 style="height: 52px; width: auto;">
        </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
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
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-bold mb-3">Informasi Kontak</h6>
                    <a href="mailto:vokasi@ub.ac.id" class="nav-link text-light p-0">vokasi@ub.ac.id</a>
                    <p class="nav-item"><span class="nav-link text-light p-0">+62 85791924555</span></p>
                    <p><span class="nav-link text-light p-0">Jl. Veteran No.8, Ketawanggede, Kec. Lowokwaru, Kota Malang, Jawa Timur 65145</span></p>
                </div>
            </div>
            <hr class="my-4 bg-white opacity-25">
            <div class="text-center text-white-50 small">
                <p class="mb-0">&copy; {{ date('Y') }} Sistem Manajemen K3. All rights reserved.</p>
                <p class="mb-2 small"> Sistem K3 v1.0.0 </p>
            </div>
        </div>
    </footer>
</body>
</html>
