<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Sistem K3' }} - VokasiEvac</title>

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

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        /* --- Navbar Styles --- */
        .navbar-custom {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 0.8rem 0;
        }

        /* Grouping Brand & Partner Logo */
        .brand-wrapper {
            display: flex;
            align-items: center;
            gap: 12px; /* Jarak antar logo */
        }

        .navbar-brand {
            font-size: 1.2rem;
            margin-right: 0;
            padding: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Garis Pemisah (Divider) */
        .brand-divider {
            height: 32px;
            width: 1px;
            background-color: rgba(255, 255, 255, 0.3);
        }

        /* Logo Fakultas Container */
        .partner-logo-box {
            background: white;
            padding: 4px 8px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .partner-logo-img {
            height: 36px;
            width: auto;
        }

        /* Toggler (Hamburger) */
        .navbar-toggler {
            border: none;
            padding: 0;
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
        }

        /* Footer */
        .footer-custom {
            background: var(--color-primary);
            color: white;
            margin-top: auto;
        }

        /* --- Responsive Tweaks --- */
        @media (max-width: 576px) {
            /* Di HP layar kecil, kecilkan sedikit logo */
            .navbar-brand span {
                display: none; /* Sembunyikan teks "VokasiEvac" jika layar sangat sempit, atau biarkan jika muat */
            }
            .navbar-brand span.show-mobile {
                display: block;
                font-size: 1rem;
            }
            .partner-logo-img {
                height: 30px;
            }
            .brand-divider {
                height: 28px;
            }
        }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
        <div class="container">
            
            <div class="brand-wrapper">
                <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.8 11.8 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7 7 0 0 0 1.048-.625 11.8 11.8 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.54 1.54 0 0 0-1.044-1.263 63 63 0 0 0-2.887-.87C9.843.266 8.69 0 8 0m0 5a1.5 1.5 0 0 1 .5 2.915l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99A1.5 .5 0 0 1 8 5"/>
                    </svg>
                    <span class="show-mobile">VokasiEvac</span>
                </a>

                <div class="brand-divider"></div>

                <div class="partner-logo-box">
                    <img src="{{ asset('images/Logo-FVUB.jpg') }}" 
                         alt="Fakultas Vokasi" 
                         class="partner-logo-img">
                </div>
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer class="footer-custom mt-5 py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6">
                    <h5 class="fw-bold mb-3">Sistem Manajemen K3</h5>
                    <p class="text-white-50">Sistem informasi jalur evakuasi dan mitigasi bencana lingkungan kerja Fakultas Vokasi UB.</p>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-bold mb-3 text-warning">Menu</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-white text-decoration-none">Beranda</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="fw-bold mb-3 text-warning">Kontak</h6>
                    <a href="mailto:vokasi@ub.ac.id" class="nav-link text-light p-0">vokasi@ub.ac.id</a>
                    <p>+62 85791924555</p>
                    <p>Jl. Veteran No.8, Ketawanggede, Kec. Lowokwaru, Kota Malang, Jawa Timur 65145</p>
                </div>
            </div>
            <hr class="my-4 bg-white opacity-25">
            <div class="text-center text-white-50 small">
                <p class="mb-0">&copy; {{ date('Y') }} Fakultas Vokasi UB. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>