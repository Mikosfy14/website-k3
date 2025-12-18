<x-layouts.public>
    <x-slot:title>Hasil Pencarian Jalur Evakuasi</x-slot:title>

    <div class="container py-5">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('home') }}" class="btn btn-outline-secondary fw-bold px-4">
                Kembali
            </a>
        </div>

        <div class="row">
            <!-- Informasi Lokasi -->
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-lg mb-4">
                    <div class="card-header text-white" style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);">
                        <h5 class="mb-0">
                        <svg fill="#ffffff" width="90px" height="90px" viewBox="0 0 19.00 19.00" xmlns="http://www.w3.org/2000/svg" class="cf-icon-svg" stroke="#ffffff" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)" stroke-width="0.589"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier">
                            <path d="M15.084 15.2H.916a.264.264 0 0 1-.254-.42l2.36-4.492a.865.865 0 0 1 .696-.42h.827a9.51 9.51 0 0 0 .943 1.108H3.912l-1.637 3.116h11.45l-1.637-3.116h-1.34a9.481 9.481 0 0 0 .943-1.109h.591a.866.866 0 0 1 .696.421l2.36 4.492a.264.264 0 0 1-.254.42zM11.4 7.189c0 2.64-2.176 2.888-3.103 5.46a.182.182 0 0 1-.356 0c-.928-2.572-3.104-2.82-3.104-5.46a3.282 3.282 0 0 1 6.563 0zm-1.86-.005a1.425 1.425 0 1 0-1.425 1.425A1.425 1.425 0 0 0 9.54 7.184z"></path>
                        </g>
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
                            <svg fill="#ffffff" height="80px" width="80px" version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve" stroke="#ffffff" stroke-width="0.00032"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier"> <path d="M30.9,13.6c-0.1-0.1-0.1-0.2-0.2-0.3l-4-4c-0.4-0.4-1-0.4-1.4,0s-0.4,1,0,1.4l2.3,2.3H22v-3V3c0-0.6-0.4-1-1-1H4 c0,0,0,0,0,0C3.9,2,3.7,2,3.6,2.1c0,0,0,0-0.1,0c0,0-0.1,0-0.1,0.1c0,0-0.1,0.1-0.1,0.1c0,0,0,0,0,0C3.2,2.4,3.1,2.5,3.1,2.6 c0,0,0,0,0,0.1C3,2.8,3,2.9,3,3v22c0,0.4,0.2,0.8,0.6,0.9l9,4C12.7,30,12.9,30,13,30c0.2,0,0.4-0.1,0.5-0.2c0.3-0.2,0.5-0.5,0.5-0.8 v-3h7c0.6,0,1-0.4,1-1V15h5.6l-2.3,2.3c-0.4,0.4-0.4,1,0,1.4c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3l4-4c0.1-0.1,0.2-0.2,0.2-0.3 C31,14.1,31,13.9,30.9,13.6z M10,21c0,0.6-0.4,1-1,1s-1-0.4-1-1v-4c0-0.6,0.4-1,1-1s1,0.4,1,1V21z M20,10v14h-6V7 c0-0.4-0.2-0.8-0.6-0.9L8.7,4H20V10z"></path>
                                </g>
                            </svg>
                                Informasi Jalur Evakuasi
                            </h4>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="mb-3 fw-bold text-primary-custom">{{ $jalur->nama_jalur }}</h5>

                    @if(!empty($jalur->gambar_urls) && count($jalur->gambar_urls) > 0)
                        <div class="mb-4">
                            <!-- Heading Section -->
                            <div class="mb-3">
                                <div class="d-flex align-items-center text-muted mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2"/>
                                    </svg>
                                    <small>Klik gambar untuk melihat ukuran penuh</small>
                                </div>
                            </div>
                            
                            <!-- Gambar Section -->
                            <div class="row g-3">
                                @foreach($jalur->gambar_urls as $index => $imagePath)
                                <div class="col-md-6 col-lg-4">
                                    <div class="text-center">
                                        <!-- Clickable Pict -->
                                        <div class="image-container position-relative mb-2">
                                            <img src="{{ asset('storage/' . $imagePath) }}"
                                                alt="Peta Jalur {{ $jalur->nama_jalur }} - Gambar {{ $index + 1 }}"
                                                class="img-fluid rounded border shadow-sm clickable-image"
                                                style="max-height: 300px; object-fit: contain; cursor: pointer; transition: all 0.3s ease;"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#imageModal"
                                                data-image-src="{{ asset('storage/' . $imagePath) }}"
                                                data-image-name="Peta Jalur {{ $jalur->nama_jalur }} - Gambar {{ $index + 1 }}"
                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                            
                                            <!-- Overlay effect pada hover -->
                                            <div class="image-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center rounded" 
                                                style="background: rgba(0,0,0,0.7); opacity: 0; transition: opacity 0.3s ease; pointer-events: none;">
                                                <div class="text-white text-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                                    </svg>
                                                    <div class="small mt-1">Klik untuk memperbesar</div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="alert alert-secondary mt-2" style="display: none;">
                                            Gambar {{ $index + 1 }} tidak dapat dimuat
                                        </div>
                                        
                                        @if(count($jalur->gambar_urls) > 1)
                                        <small class="text-muted d-block mt-2">Gambar {{ $index + 1 }}</small>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($jalur->deskripsi_teks)
                        <div class="mb-4">
                            <h6 class="fw-semibold" style="color: var(--color-primary); mb-3">Instruksi Evakuasi</h6>
                            <div class="bg-light p-4 rounded border">
                                <p class="mb-0 fw-medium" style="font-size: 1.1rem; color: #74c365; line-height: 1.6;">
                                    {!! nl2br(e($jalur->deskripsi_teks)) !!}
                                </p>
                            </div>
                        </div>
                    @endif

                    @if($jalur->assembly_point)
                        <div class="alert alert-info border-0">
                            <div class="d-flex align-items-start">
                    <svg width="20px" height="20px" viewBox="0 0 72 72" id="emoji" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g id="color"> <path fill="#003366" d="M46.289,21.3899c0-6.0159-4.6073-10.9096-10.271-10.9096S25.747,15.374,25.747,21.3926 c0.0018,0.3005,0.1445,7.4974,8.3708,20.1793c0.53,0.8288,1.1424,1.2493,1.8196,1.2493c1.1879,0,1.9983-1.3088,2.0771-1.442 C46.2934,28.6902,46.2934,21.6764,46.289,21.3899z M36.0181,25.784c-2.5222,0-4.5742-2.052-4.5742-4.5742 s2.052-4.5742,4.5742-4.5742s4.5742,2.052,4.5742,4.5742S38.5403,25.784,36.0181,25.784z"></path> <path fill="#003366" d="M46.289,21.3899c0-6.0159-4.6073-10.9096-10.271-10.9096c-0.8622,0-1.6952,0.1258-2.4958,0.3393 c5.4217,0.2902,9.7514,5.0521,9.7514,10.8817c0.0044,0.2865,0.0044,7.3003-8.2745,19.9892 c-0.0296,0.0499-0.1621,0.2652-0.3788,0.5149c0.4037,0.406,0.8442,0.6157,1.3171,0.6157c1.1879,0,1.9983-1.3088,2.0771-1.442 C46.2934,28.6902,46.2934,21.6764,46.289,21.3899z"></path> <path fill="#003366" d="M11.3402,60.6539v-2.285c0-3.23,1.9102-5.45,5.1402-5.45c1.9123,1.6148,4.1757,2.4223,6.1092,2.4225 c1.934,0.0002,4.1979-0.8073,6.1107-2.4225c3.23,0,5.1402,2.22,5.1402,5.45v2.285H11.3402z"></path> <path fill="#003366" d="M38.142,60.6539v-2.285c0-3.23,1.9102-5.45,5.1402-5.45c1.9123,1.6148,4.1757,2.4223,6.1092,2.4225 c1.934,0.0002,4.1979-0.8073,6.1107-2.4225c3.23,0,5.1402,2.22,5.1402,5.45v2.285H38.142z"></path> </g> <g id="skin"> <circle cx="22.5904" cy="45.397" r="5" fill="#003366"></circle> <circle cx="49.3921" cy="45.397" r="5" fill="#003366"></circle> </g> <g id="skin-shadow"></g> <g id="hair"></g> <g id="line"> <path fill="none" stroke="#003366" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.3402,60.3239v-1.955 c0-3.23,1.9102-5.45,5.1402-5.45c1.9123,1.6148,4.1757,2.4223,6.1092,2.4225c1.934,0.0002,4.1979-0.8073,6.1107-2.4225 c3.23,0,5.1402,2.22,5.1402,5.45v1.955"></path> <path fill="none" stroke="#003366" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M38.142,60.3239v-1.955 c0-3.23,1.9102-5.45,5.1402-5.45c1.9123,1.6148,4.1757,2.4223,6.1092,2.4225c1.934,0.0002,4.1979-0.8073,6.1107-2.4225 c3.23,0,5.1402,2.22,5.1402,5.45v1.955"></path> <g> <path fill="none" stroke="#003366" stroke-miterlimit="10" stroke-width="2" d="M35.9374,42.8211 c-0.6772,0-1.2896-0.4205-1.8196-1.2493c-8.2263-12.6819-8.3691-19.8788-8.3708-20.1793c0-6.0186,4.6072-10.9123,10.271-10.9123 s10.271,4.8937,10.271,10.9096c0.0044,0.2865,0.0044,7.3003-8.2744,19.9892C37.9357,41.5123,37.1253,42.8211,35.9374,42.8211z"></path> </g> <path fill="none" stroke="#003366" stroke-miterlimit="10" stroke-width="2" d="M36.0181,25.784 c-2.5222,0-4.5742-2.052-4.5742-4.5742s2.052-4.5742,4.5742-4.5742s4.5742,2.052,4.5742,4.5742S38.5403,25.784,36.0181,25.784z"></path> <circle cx="22.5904" cy="45.397" r="5" fill="none" stroke="#003366" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle> <circle cx="49.3921" cy="45.397" r="5" fill="none" stroke="#003366" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle> </g> </g></svg>
                                <div class="flex-grow-1">
                                    <h6 class="fw-bold mb-2" style="color: var(--color-primary);">Titik Kumpul (Assembly Point)</h6>
                                    <p class="mb-0">{{ $jalur->assembly_point }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Panduan Keselamatan -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-bottom">
                            <h6 class="mb-0 fw-bold d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="var(--color-secondary)" class="me-2" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.8 11.8 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7 7 0 0 0 1.048-.625 11.8 11.8 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.54 1.54 0 0 0-1.044-1.263 63 63 0 0 0-2.887-.87C9.843.266 8.69 0 8 0m0 5a1.5 1.5 0 0 1 .5 2.915l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99A1.5 1.5 0 0 1 8 5"/>
                                </svg>
                                Panduan Keselamatan
                            </h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3 d-flex align-items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#28a745" class="me-3 mt-1 flex-shrink-0" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                    <span class="flex-grow-1">Tetap tenang dan jangan panik</span>
                                </li>
                                <li class="mb-3 d-flex align-items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#28a745" class="me-3 mt-1 flex-shrink-0" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                    <span class="flex-grow-1">Jangan menggunakan lift saat darurat</span>
                                </li>
                                <li class="mb-3 d-flex align-items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#28a745" class="me-3 mt-1 flex-shrink-0" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                    <span class="flex-grow-1">Ikuti petunjuk petugas keselamatan</span>
                                </li>
                                <li class="mb-3 d-flex align-items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#28a745" class="me-3 mt-1 flex-shrink-0" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                    <span class="flex-grow-1">Bantu orang lain jika memungkinkan</span>
                                </li>
                                <li class="mb-0 d-flex align-items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#28a745" class="me-3 mt-1 flex-shrink-0" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                    <span class="flex-grow-1">Laporkan kondisi Anda setelah aman</span>
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

                <!-- Modal untuk Full Size Image -->
                <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imageModalLabel">Peta Jalur Evakuasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <img id="modalImage" src="" alt="Full Size Evacuation Route" class="img-fluid" style="max-height: 80vh; object-fit: contain;">
                            </div>
                            <div class="modal-footer">
                                <a id="downloadLink" href="#" class="btn btn-primary" style="font-weight: bold;" download>
                                    Download
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle click on images
    const clickableImages = document.querySelectorAll('.clickable-image');
    clickableImages.forEach(img => {
        img.addEventListener('click', function() {
            const imageSrc = this.getAttribute('data-image-src');
            const imageName = this.getAttribute('data-image-name');
            openImageModal(imageSrc, imageName);
        });
    });

    // Hover effects
    const imageContainers = document.querySelectorAll('.image-container');
    imageContainers.forEach(container => {
        const image = container.querySelector('.clickable-image');
        const overlay = container.querySelector('.image-overlay');
        
        container.addEventListener('mouseenter', function() {
            overlay.style.opacity = '1';
            image.style.transform = 'scale(1.02)';
        });
        
        container.addEventListener('mouseleave', function() {
            overlay.style.opacity = '0';
            image.style.transform = 'scale(1)';
        });
    });

    // Function to open modal with image
    function openImageModal(imageSrc, imageName) {
        const modalImage = document.getElementById('modalImage');
        const modalTitle = document.getElementById('imageModalLabel');
        const downloadLink = document.getElementById('downloadLink');
        
        modalImage.src = imageSrc;
        modalImage.alt = imageName;
        modalTitle.textContent = imageName;
        downloadLink.href = imageSrc;
        downloadLink.download = imageName.replace(/ /g, '_') + '.jpg';
    }

    // Reset modal when closed
    const imageModal = document.getElementById('imageModal');
    imageModal.addEventListener('hidden.bs.modal', function () {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = '';
    });
});
</script>

<style>
/* Konsistensi heading */
.fw-semibold.text-primary {
    font-size: 1.1rem;
    border-bottom: 2px solid var(--color-primary);
    padding-bottom: 0.5rem;
    margin-bottom: 1rem;
}

/* Efek hover gambar */
.clickable-image {
    transition: all 0.3s ease !important;
}

.image-container:hover .clickable-image {
    transform: scale(1.02);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.image-overlay {
    transition: opacity 0.3s ease;
}

.image-container {
    border-radius: 8px;
    overflow: hidden;
}

.clickable-image {
    cursor: zoom-in;
}

/* Style untuk instruksi */
.bg-light.rounded.border {
    border-left: 4px solid var(--color-primary) !important;
}
</style>
</x-layouts.public>
