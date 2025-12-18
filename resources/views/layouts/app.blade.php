<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - {{ config('app.name', 'Website K3') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="d-flex">
    <!-- TOGGLE BUTTON -->
    <button class="sidebar-toggle" id="sidebarToggle">
        ☰ Menu
    </button>

    <!-- Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar - DEFAULT HIDDEN DI MOBILE -->
    <aside class="bg-light sidebar d-flex flex-column p-3" style="width: 250px; height: 100vh; position: fixed; z-index: 1000;">
        <h4 class="text-center mb-4" style="color: #003366;">Admin Panel K3</h4>
        <nav class="nav flex-column">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16" style="display: inline-block; vertical-align: text-bottom;">
                    <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4M3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.39.39 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.39.39 0 0 0-.029-.518z"/>
                    <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A8 8 0 0 1 0 10m8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3"/>
                </svg>
                Dashboard
            </a>
            <a class="nav-link {{ request()->routeIs('admin.gedung.*') ? 'active' : '' }}" href="{{ route('admin.gedung.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16" style="display: inline-block; vertical-align: text-bottom;">
                    <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5"/>
                </svg>
                Kelola Gedung
            </a>
            <a class="nav-link {{ request()->routeIs('admin.jalur-mitigasi.*') ? 'active' : '' }}" href="{{ route('admin.jalur-mitigasi.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16" style="display: inline-block; vertical-align: text-bottom;">
                    <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5"/>
                </svg>
                Kelola Jalur Mitigasi
            </a>
            <a class="nav-link {{ request()->routeIs('admin.lantai.*') ? 'active' : '' }}" href="{{ route('admin.lantai.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16" style="display: inline-block; vertical-align: text-bottom;">
                    <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6z"/>
                </svg>
                Kelola Lantai
            </a>
            <a class="nav-link {{ request()->routeIs('admin.ruangan.*') ? 'active' : '' }}" href="{{ route('admin.ruangan.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16" style="display: inline-block; vertical-align: text-bottom;">
                    <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5"/>
                </svg>
                Kelola Ruangan
            </a>
        </nav>
        <hr class="my-4">
        <form method="POST" action="{{ route('logout') }}" class="mt-auto" id="logout-form">
            @csrf
            <button type="submit" class="btn btn-link nav-link text-danger w-100 text-start btn-logout-custom" style="text-decoration: bold;">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                </svg>
                Logout
            </button>
        </form>
    </aside>

    <!-- Main Content -->
    <div class="flex-grow-1 p-3 main-content" style="margin-left: 250px; min-height: 100vh; transition: margin-left 0.3s ease;">
        <nav class="navbar navbar-light bg-light mb-3 rounded shadow-sm">
            <span class="navbar-brand ms-3">Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}!</span>
        </nav>
        @yield('content')
    </div>

    <!-- SIMPLE JAVASCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            console.log('Script loaded');
            console.log('Toggle button:', toggleBtn);
            console.log('Sidebar:', sidebar);
            
            // Function to check screen size and set initial state
            function checkScreenSize() {
                if (window.innerWidth <= 1024) {
                    // Mobile - hide sidebar by default
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    toggleBtn.classList.remove('shifted');
                    toggleBtn.textContent = '☰ Menu';
                    console.log('Mobile mode - sidebar hidden');
                } else {
                    // Desktop - show sidebar
                    sidebar.classList.add('active');
                    console.log('Desktop mode - sidebar visible');
                }
            }
            
            // Initial check
            checkScreenSize();
            
            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', function() {
                    console.log('Toggle button clicked');
                    
                    sidebar.classList.toggle('active');
                    overlay.classList.toggle('active');
                    toggleBtn.classList.toggle('shifted');
                    
                    if (sidebar.classList.contains('active')) {
                        toggleBtn.textContent = '✕ Close';
                        console.log('Sidebar opened');
                    } else {
                        toggleBtn.textContent = '☰ Menu';
                        console.log('Sidebar closed');
                    }
                });
                
                // Close sidebar when overlay clicked
                if (overlay) {
                    overlay.addEventListener('click', function() {
                        sidebar.classList.remove('active');
                        overlay.classList.remove('active');
                        toggleBtn.classList.remove('shifted');
                        toggleBtn.textContent = '☰ Menu';
                    });
                }
                
                // Close sidebar when nav link clicked (mobile)
                document.querySelectorAll('.nav-link').forEach(link => {
                    link.addEventListener('click', function() {
                        if (window.innerWidth <= 1024) {
                            setTimeout(() => {
                                sidebar.classList.remove('active');
                                overlay.classList.remove('active');
                                toggleBtn.classList.remove('shifted');
                                toggleBtn.textContent = '☰ Menu';
                            }, 300);
                        }
                    });
                });
            }
            
            // Handle window resize
            window.addEventListener('resize', checkScreenSize);
        });
    </script>
</body>
</html>