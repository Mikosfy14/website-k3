<x-layouts.public>
    <x-slot:title>Hasil Pencarian Jalur Evakuasi</x-slot:title>

    <div class="container py-5">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                </svg>
                Kembali
            </a>
        </div>

        <div class="row">
            <!-- Informasi Lokasi -->
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-lg mb-4">
                    <div class="card-header text-white" style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);">
                        <h5 class="mb-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                            </svg>
                            Lokasi Anda
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="text-muted small mb-1">Gedung</label>
                            <p class="fw-bold mb-0">{{ $lantai->gedung->nama_gedung ?? 'N/A' }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted small mb-1">Lantai</label>
                            <p class="fw-bold mb-0">{{ $lantai->nama_lantai ?? 'N/A' }}</p>
                        </div>
                        @if(isset($ruanganInput) && $ruanganInput)
                            <div class="mb-3">
                                <label class="text-muted small mb-1">Ruangan</label>
                                <p class="fw-bold mb-0">{{ $ruanganInput }}</p>
                            </div>
                        @endif

                        <hr>

                        <div class="alert alert-warning border-0 mb-0">
                            <small>
                                <strong>Penting!</strong> Ikuti jalur evakuasi yang ditunjukkan dengan tenang dan tertib.
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jalur Evakuasi -->
            <div class="col-lg-8">
                @if($jalur)
                    <div class="card border-0 shadow-lg mb-4">
                        <div class="card-header bg-success text-white py-3">
                            <h4 class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5"/>
                                </svg>
                                Jalur Evakuasi Ditemukan
                            </h4>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="mb-3 fw-bold text-primary-custom">{{ $jalur->nama_jalur }}</h5>

                            @if($jalur->gambar_jalur_url)
                                <div class="mb-4">
                                    <img src="{{ asset('storage/' . $jalur->gambar_jalur_url) }}"
                                         alt="Peta Jalur {{ $jalur->nama_jalur }}"
                                         class="img-fluid rounded border shadow-sm"
                                         onerror="this.parentElement.innerHTML='<div class=\'alert alert-secondary\'>Gambar jalur tidak tersedia</div>'">
                                         
                                </div>
                            @endif

                            @if($jalur->deskripsi_teks)
                                <div class="mb-4">
                                    <h6 class="fw-bold text-muted mb-3">Instruksi Evakuasi:</h6>
                                    <div class="bg-light p-3 rounded">
                                        <p class="mb-0">{!! nl2br(e($jalur->deskripsi_teks)) !!}</p>
                                    </div>
                                </div>
                            @endif

                            @if($jalur->assembly_point)
                                <div class="alert alert-info border-0">
                                    <h6 class="fw-bold mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                                        </svg>
                                        Titik Kumpul (Assembly Point):
                                    </h6>
                                    <p class="mb-0 ms-4">{{ $jalur->assembly_point }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Panduan Keselamatan -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-bottom">
                            <h6 class="mb-0 fw-bold">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="var(--color-secondary)" class="me-2" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.8 11.8 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7 7 0 0 0 1.048-.625 11.8 11.8 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.54 1.54 0 0 0-1.044-1.263 63 63 0 0 0-2.887-.87C9.843.266 8.69 0 8 0m0 5a1.5 1.5 0 0 1 .5 2.915l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99A1.5 1.5 0 0 1 8 5"/>
                                </svg>
                                Panduan Keselamatan
                            </h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="me-2" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                    Tetap tenang dan jangan panik
                                </li>
                                <li class="mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="me-2" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                    Jangan menggunakan lift saat darurat
                                </li>
                                <li class="mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="me-2" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                    Ikuti petunjuk petugas keselamatan
                                </li>
                                <li class="mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="me-2" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                    Bantu orang lain jika memungkinkan
                                </li>
                                <li class="mb-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="me-2" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                    Laporkan kondisi Anda setelah aman
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    <div class="card border-0 shadow-lg">
                        <div class="card-header bg-danger text-white py-3">
                            <h4 class="mb-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
                                </svg>
                                Jalur Evakuasi Tidak Ditemukan
                            </h4>
                        </div>
                        <div class="card-body p-4">
                            <p>Mohon maaf, jalur evakuasi untuk lokasi ini belum tersedia dalam sistem.</p>
                            <p class="mb-0">Silakan hubungi petugas keselamatan atau coba lokasi lain.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.public>
