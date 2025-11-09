<x-layouts.public>
    <x-slot:title>Beranda</x-slot:title>

    <!-- Hero Section -->
    <section class="py-5" style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-white">
                    <h1 class="display-4 fw-bold mb-4">Sistem Pencarian Jalur Evakuasi</h1>
                    <p class="lead mb-4">Temukan jalur evakuasi terdekat dari lokasi Anda dengan cepat dan mudah. Keselamatan adalah prioritas utama kami.</p>
                    <div class="d-flex gap-3">
                        <a href="#cari-jalur" class="btn btn-secondary-custom btn-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="me-2" viewBox="0 0 16 16" style="display: inline-block; vertical-align: text-bottom;">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                            </svg>
                            Cari Jalur Sekarang
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center mt-5 mt-lg-0">
                    <div class="p-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="300" height="300" fill="var(--color-secondary)" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z"/>
                        </svg>
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
                    <div class="card border-0 shadow-lg">
                        <div class="card-body p-5">
                            <h2 class="text-center mb-4 fw-bold text-primary-custom">Cari Jalur Evakuasi</h2>
                            <p class="text-center text-muted mb-4">Masukkan informasi lantai atau ruangan Anda untuk menemukan jalur evakuasi terdekat</p>

                            @if(session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong> {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('cari.evakuasi') }}">
                                @csrf

                                <div class="mb-4">
                                    <label for="lantai" class="form-label fw-semibold">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                                            <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6z"/>
                                        </svg>
                                        Lantai
                                    </label>
                                    <input type="text" class="form-control form-control-lg @error('lantai') is-invalid @enderror"
                                           id="lantai" name="lantai" placeholder="Contoh: Lantai 1, Lantai 2, dll"
                                           value="{{ old('lantai') }}" required>
                                    @error('lantai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Masukkan nama lantai tempat Anda berada</div>
                                </div>

                                <div class="mb-4">
                                    <label for="ruangan" class="form-label fw-semibold">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                                            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5"/>
                                        </svg>
                                        Ruangan (Opsional)
                                    </label>
                                    <input type="text" class="form-control form-control-lg"
                                           id="ruangan" name="ruangan" placeholder="Contoh: Ruang 101, Lab Komputer, dll"
                                           value="{{ old('ruangan') }}">
                                    <div class="form-text">Opsional: Masukkan nama atau kode ruangan untuk pencarian lebih spesifik</div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary-custom btn-lg">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5"/>
                                        </svg>
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
    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold text-primary-custom">Kenapa Penting Mengetahui Jalur Evakuasi?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 h-100 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="var(--color-secondary)" viewBox="0 0 16 16">
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5M4.285 9.567a.5.5 0 0 1 .683.183A3.5 3.5 0 0 0 8 11.5a3.5 3.5 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683M10 8c-.552 0-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5S10.552 8 10 8"/>
                                </svg>
                            </div>
                            <h5 class="fw-bold mb-3">Keselamatan Terjamin</h5>
                            <p class="text-muted">Mengetahui jalur evakuasi memastikan Anda dapat keluar dengan aman saat darurat</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 h-100 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="var(--color-primary)" viewBox="0 0 16 16">
                                    <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z"/>
                                    <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z"/>
                                    <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5"/>
                                </svg>
                            </div>
                            <h5 class="fw-bold mb-3">Respon Cepat</h5>
                            <p class="text-muted">Waktu sangat berharga saat darurat. Jalur yang tepat menghemat waktu evakuasi</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 h-100 shadow-sm">
                        <div class="card-body text-center p-4">
                            <div class="mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="var(--color-secondary)" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.8 11.8 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7 7 0 0 0 1.048-.625 11.8 11.8 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.54 1.54 0 0 0-1.044-1.263 63 63 0 0 0-2.887-.87C9.843.266 8.69 0 8 0m0 5a1.5 1.5 0 0 1 .5 2.915l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99A1.5 1.5 0 0 1 8 5"/>
                                </svg>
                            </div>
                            <h5 class="fw-bold mb-3">Protokol K3</h5>
                            <p class="text-muted">Sesuai standar Keselamatan dan Kesehatan Kerja yang berlaku</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.public>
