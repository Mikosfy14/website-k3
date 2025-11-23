<x-layouts.public>
    <x-slot:title>Beranda</x-slot:title>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container-fluid">
            <div class="row align-items-center min-vh-100">
                <!-- Content di sebelah kiri -->
                <div class="col-lg-6">
                    <div class="ps-lg-5">
                        <h1 class="display-4 fw-bold mb-3 animate-fade-in-up" style="animation-delay: 0.2s;">Sistem Informasi Jalur Evakuasi</h1>
                        <p class="lead mb-4 animate-fade-in-up" style="animation-delay: 0.4s;">Temukan jalur evakuasi terdekat berdasarkan lokasi Anda saat ini. Keselamatan Anda adalah prioritas kami.</p>
                    </div>
                </div>
                
                <!-- Gambar di sebelah kanan -->
                <div class="col-lg-6 position-relative">
                    <div class="hero-image-container">
                        <img src="{{ asset('images/evacuation-hero.jpg') }}" alt="ub dieng" class="hero-image animate-fade-in-left" style="animation-delay: 0.6s;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Search Form Section -->
    <section id="cari-jalur" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-lg animate-fade-in-up" style="animation-delay: 0.8s;">
                        <div class="card-body p-5">
                            <h2 class="text-center mb-4 fw-bold text-primary-custom animate-fade-in" style="animation-delay: 1s;">Cari Jalur Evakuasi</h2>
                            <p class="text-center text-muted mb-4 animate-fade-in" style="animation-delay: 1.1s;">Masukkan informasi lantai atau ruangan Anda untuk menemukan jalur evakuasi terdekat</p>

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong> {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('cari.evakuasi') }}">
                                @csrf

                                <div class="mb-4 animate-fade-in-up" style="animation-delay: 1.2s;">
                                    <label for="lantai" class="form-label fw-semibold">
                                        Pilih Lantai
                                    </label>
                                    <select class="form-select form-control-lg @error('lantai') is-invalid @enderror" 
                                            id="lantai" name="lantai" required>
                                        <option value="">-- Pilih Lantai --</option>
                                        @foreach($lantais as $lantai)
                                            <option value="{{ $lantai->nama_lantai }}" 
                                                {{ old('lantai') == $lantai->nama_lantai ? 'selected' : '' }}>
                                                {{ $lantai->nama_lantai }} - {{ $lantai->gedung->nama_gedung }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('lantai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Masukkan nama lantai tempat Anda berada</div>
                                </div>

                                <div class="mb-4 animate-fade-in-up" style="animation-delay: 1.3s;">
                                    <label for="ruangan" class="form-label fw-semibold">
                                        Pilih Ruangan (Opsional)
                                    </label>
                                    <select class="form-select form-control-lg @error('ruangan') is-invalid @enderror" 
                                    id="ruangan" name="ruangan">
                                        <option value="">-- Pilih Ruangan (Opsional) --</option>
                                        <!-- Ruangan akan di-load via JavaScript -->
                                    </select>
                                    @error('ruangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Kosongkan jika ingin mencari berdasarkan lantai saja</small>
                                </div>

                                <div class="d-grid animate-fade-in-up" style="animation-delay: 1.4s;">
                                    <button type="submit" class="btn btn-primary-search btn-lg fw-bold py-3">
                                        Cari Jalur Evakuasi
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold animate-fade-in-up" style="color: var(--color-primary); animation-delay: 1.5s;">Kenapa Penting Mengetahui Jalur Evakuasi?</h2>
            <div class="row g-4">
                <!-- Card 1: Keselamatan Terjamin -->
                <div class="col-md-4">
                    <div class="card info-card border-0 h-100 shadow-hover animate-fade-in-up" style="animation-delay: 1.6s;">
                        <div class="card-body text-center p-4 d-flex flex-column">
                            <div class="icon-container mb-4 mx-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="var(--color-secondary)" viewBox="0 0 16 16" class="info-icon">
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8"/>
                                </svg>
                            </div>
                            <h5 class="fw-bold mb-3" style="color: var(--color-primary);">Keselamatan Terjamin</h5>
                            <p class="text-muted flex-grow-1">Mengetahui jalur evakuasi memastikan Anda dapat keluar dengan aman saat darurat</p>
                        </div>
                    </div>
                </div>
                
                <!-- Card 2: Respon Cepat -->
                <div class="col-md-4">
                    <div class="card info-card border-0 h-100 shadow-hover animate-fade-in-up" style="animation-delay: 1.7s;">
                        <div class="card-body text-center p-4 d-flex flex-column">
                            <div class="icon-container mb-4 mx-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="var(--color-secondary)" viewBox="0 0 16 16" class="info-icon">
                                    <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z"/>
                                    <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z"/>
                                    <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                            </div>
                            <h5 class="fw-bold mb-3" style="color: var(--color-primary);">Respon Cepat</h5>
                            <p class="text-muted flex-grow-1">Waktu sangat berharga saat darurat. Jalur yang tepat menghemat waktu evakuasi</p>
                        </div>
                    </div>
                </div>
                
                <!-- Card 3: Protokol K3 -->
                <div class="col-md-4">
                    <div class="card info-card border-0 h-100 shadow-hover animate-fade-in-up" style="animation-delay: 1.8s;">
                        <div class="card-body text-center p-4 d-flex flex-column">
                            <div class="icon-container mb-4 mx-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="var(--color-secondary)" viewBox="0 0 16 16" class="info-icon">
                                    <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.8 11.8 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7 7 0 0 0 1.048-.625 11.8 11.8 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.54 1.54 0 0 0-1.044-1.263 63 63 0 0 0-2.887-.87C9.843.266 8.69 0 8 0m0 5a1.5 1.5 0 0 1 .5 2.915l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99A1.5 1.5 0 0 1 8 5"/>
                                </svg>
                            </div>
                            <h5 class="fw-bold mb-3" style="color: var(--color-primary);">Protokol K3</h5>
                            <p class="text-muted flex-grow-1">Sesuai standar Keselamatan dan Kesehatan Kerja yang berlaku</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lantaiSelect = document.getElementById('lantai');
            const ruanganSelect = document.getElementById('ruangan');
            
            // Data ruangan per lantai (dari PHP via JSON)
            const ruanganData = {!! $ruanganDataJson !!};

            lantaiSelect.addEventListener('change', function() {
                const selectedLantai = this.value;
                
                // Reset dropdown ruangan
                ruanganSelect.innerHTML = '<option value="">-- Pilih Ruangan (Opsional) --</option>';
                
                if (selectedLantai && ruanganData[selectedLantai]) {
                    ruanganData[selectedLantai].forEach(ruangan => {
                        const option = document.createElement('option');
                        option.value = ruangan.nama_ruangan;
                        option.textContent = ruangan.nama_ruangan + ' (' + ruangan.kode_ruangan + ')';
                        ruanganSelect.appendChild(option);
                    });
                }
            });

            // Trigger change event jika ada nilai sebelumnya
            @if(old('lantai'))
                lantaiSelect.value = "{{ old('lantai') }}";
                lantaiSelect.dispatchEvent(new Event('change'));
                
                @if(old('ruangan'))
                    setTimeout(() => {
                        ruanganSelect.value = "{{ old('ruangan') }}";
                    }, 100);
                @endif
            @endif

            // Efek untuk tombol pencarian
            const searchButton = document.querySelector('.btn-primary-search');
            const form = document.querySelector('form');
            
            if (searchButton && form) {
                searchButton.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px) scale(1.02)';
                });
                
                searchButton.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
                
                form.addEventListener('submit', function() {
                    searchButton.classList.add('loading');
                    searchButton.innerHTML = 'Mencari...';
                    
                    setTimeout(() => {
                        searchButton.classList.remove('loading');
                        searchButton.innerHTML = 'Cari Jalur Evakuasi';
                    }, 2000);
                });
            }

            // Animasi scroll trigger
            const animateOnScroll = function() {
                const elements = document.querySelectorAll('.animate-on-scroll');
                elements.forEach(element => {
                    const elementTop = element.getBoundingClientRect().top;
                    const elementVisible = 150;
                    
                    if (elementTop < window.innerHeight - elementVisible) {
                        element.classList.add('animated');
                    }
                });
            };

            // Initial check
            animateOnScroll();
            window.addEventListener('scroll', animateOnScroll);
        });
    </script>

    <style>
        /* Animasi Base Styles */
        .animate-fade-in {
            opacity: 0;
            animation: fadeIn 1s ease-out forwards;
        }

        .animate-fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .animate-fade-in-left {
            opacity: 0;
            transform: translateX(30px);
            animation: fadeInLeft 0.8s ease-out forwards;
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }

        .animate-on-scroll.animated {
            opacity: 1;
            transform: translateY(0);
        }

        /* Keyframes */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes bounceIn {
            from {
                opacity: 0;
                transform: scale(0.3);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Style untuk info cards */
        .info-card {
            transition: all 0.3s ease;
            border-radius: 15px;
            background: white;
            position: relative;
            overflow: hidden;
        }

        .info-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .info-card:hover::before {
            transform: scaleX(1);
        }

        .shadow-hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .shadow-hover:hover {
            box-shadow: 0 8px 30px rgba(0,0,0,0.15);
            transform: translateY(-5px);
        }

        /* Style untuk icon */
        .icon-container {
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .info-card:hover .icon-container {
            background: linear-gradient(135deg, var(--color-primary-light) 0%, var(--color-secondary-light) 100%);
            transform: scale(1.1);
        }

        .info-icon {
            transition: all 0.3s ease;
        }

        .info-card:hover .info-icon {
            transform: scale(1.1);
            filter: brightness(1.2);
        }

        /* Style untuk tombol pencarian */
        .btn-primary-search {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
            border: none;
            color: white;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1.1rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
        }

        .btn-primary-search::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-primary-search:hover {
            background: linear-gradient(135deg, var(--color-primary-dark) 0%, var(--color-primary) 100%);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            color: white;
        }

        .btn-primary-search:hover::before {
            left: 100%;
        }

        .btn-primary-search:active {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.25);
        }

        .btn-primary-search:focus {
            box-shadow: 0 0 0 3px rgba(var(--color-primary-rgb), 0.3);
        }

        /* Efek loading saat diklik */
        .btn-primary-search.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .btn-primary-search.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin: -10px 0 0 -10px;
            border: 2px solid transparent;
            border-top: 2px solid #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .icon-container {
                width: 80px;
                height: 80px;
            }
            
            .info-icon {
                width: 60px;
                height: 60px;
            }
            
            .animate-fade-in-up,
            .animate-fade-in-left {
                transform: translateY(20px);
                animation-duration: 0.6s;
            }
        }
    </style>    
</x-layouts.public>