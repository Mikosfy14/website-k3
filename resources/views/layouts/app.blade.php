<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - {{ config('app.name', 'Website K3') }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* --- LAYOUT & SIDEBAR STYLES --- */
        body {
            overflow-x: hidden; 
        }

        /* Sidebar Default (Desktop) */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
            z-index: 1050; /* Di atas overlay */
            transition: transform 0.3s ease-in-out;
            transform: translateX(0); /* Default muncul di desktop */
        }

        /* Overlay Hitam Transparan */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040; /* Di bawah sidebar, di atas konten */
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
        }

        /* Tombol Toggle (Hamburger) */
        .sidebar-toggle {
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1060; /* Paling atas agar selalu bisa diklik */
            background: #003366;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            display: none; /* Sembunyi di desktop */
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        /* Main Content Default (Desktop) */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
            transition: margin-left 0.3s ease-in-out;
        }

        /* Nav Link Styling */
        .nav-link {
            color: #333;
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 5px;
            transition: all 0.2s;
        }
        .nav-link:hover {
            background-color: #e9ecef;
            color: #003366;
        }
        .nav-link.active {
            background-color: #003366;
            color: white;
        }

        /* --- MOBILE RESPONSIVE --- */
        @media (max-width: 991.98px) {
            /* Sidebar sembunyi di kiri layar */
            .sidebar {
                transform: translateX(-100%);
                box-shadow: 4px 0 10px rgba(0,0,0,0.1);
            }
            
            /* Sidebar muncul saat kelas .active ditambahkan */
            .sidebar.active {
                transform: translateX(0);
            }

            /* Main Content full width */
            .main-content {
                margin-left: 0;
                padding-top: 70px; /* Jarak untuk tombol toggle */
            }

            /* Tampilkan tombol toggle */
            .sidebar-toggle {
                display: block;
            }

            /* Logika Overlay */
            .sidebar-overlay.active {
                display: block;
                opacity: 1;
            }
        }
    </style>
</head>
<body class="bg-light">

    <button class="sidebar-toggle" id="sidebarToggle">
        ☰ Menu
    </button>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <aside class="sidebar d-flex flex-column p-3">
        <h4 class="text-center mb-4 mt-2 fw-bold" style="color: #003366;">Admin Panel K3</h4>
        
        <nav class="nav flex-column">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4M3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.39.39 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.39.39 0 0 0-.029-.518z"/>
                    <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A8 8 0 0 1 0 10m8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3"/>
                </svg>
                Dashboard
            </a>
            
            <a class="nav-link {{ request()->routeIs('admin.gedung.*') ? 'active' : '' }}" href="{{ route('admin.gedung.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                    <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5"/>
                </svg>
                Kelola Gedung
            </a>

            <a class="nav-link {{ request()->routeIs('admin.jalur-mitigasi.*') ? 'active' : '' }}" href="{{ route('admin.jalur-mitigasi.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5"/>
                </svg>
                Kelola Jalur Mitigasi
            </a>

            <a class="nav-link {{ request()->routeIs('admin.lantai.*') ? 'active' : '' }}" href="{{ route('admin.lantai.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                    <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6z"/>
                </svg>
                Kelola Lantai
            </a>

            <a class="nav-link {{ request()->routeIs('admin.ruangan.*') ? 'active' : '' }}" href="{{ route('admin.ruangan.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                    <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5"/>
                </svg>
                Kelola Ruangan
            </a>
        </nav>

        <hr class="my-4">
        
        <form method="POST" action="{{ route('logout') }}" class="mt-auto" id="logout-form">
            @csrf
            <button type="submit" class="btn btn-link nav-link text-danger w-100 text-start btn-logout-custom fw-bold d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                </svg>
                Logout
            </button>
        </form>
    </aside>

    <div class="main-content">
        <nav class="navbar navbar-light bg-white rounded shadow-sm border mb-4">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1 fs-6">Selamat Datang, <strong>{{ Auth::user()->name ?? 'Admin' }}</strong>!</span>
            </div>
        </nav>
        
        @yield('content')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            // Function to toggle Sidebar
            function toggleSidebar() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
                
                // Update Button Text
                if (sidebar.classList.contains('active')) {
                    toggleBtn.textContent = '✕ Tutup';
                } else {
                    toggleBtn.textContent = '☰ Menu';
                }
            }
            
            // Close Sidebar Function
            function closeSidebar() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                toggleBtn.textContent = '☰ Menu';
            }
            
            // Event Listeners
            if (toggleBtn) {
                toggleBtn.addEventListener('click', function(e) {
                    e.stopPropagation(); // Prevent bubble
                    toggleSidebar();
                });
            }
            
            if (overlay) {
                overlay.addEventListener('click', closeSidebar);
            }
            
            // Close when clicking nav links on mobile
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 991.98) {
                        closeSidebar();
                    }
                });
            });

            // Handle resize to reset states
            window.addEventListener('resize', function() {
                if (window.innerWidth > 991.98) {
                    // Desktop: Reset styles
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    toggleBtn.textContent = '☰ Menu';
                }
            });
        });
    </script>
</body>
</html>