@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.jalur-mitigasi.index') }}">Jalur Evakuasi</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4">
                    <h5 class="mb-0 fw-bold">Tambah Jalur Evakuasi Baru</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.jalur-mitigasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Nama Jalur -->
                        <div class="mb-4">
                            <label for="nama_jalur" class="form-label fw-semibold">Nama Jalur <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_jalur') is-invalid @enderror" 
                                   id="nama_jalur" name="nama_jalur" value="{{ old('nama_jalur') }}" 
                                   placeholder="Contoh: Jalur Evakuasi Utara" required>
                            @error('nama_jalur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Assembly Point -->
                        <div class="mb-4">
                            <label for="assembly_point" class="form-label fw-semibold">Assembly Point <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('assembly_point') is-invalid @enderror" 
                                   id="assembly_point" name="assembly_point" value="{{ old('assembly_point') }}" 
                                   placeholder="Contoh: Lapangan Parkir Utara" required>
                            <small class="text-muted">Lokasi titik kumpul setelah evakuasi</small>
                            @error('assembly_point')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <label for="deskripsi_teks" class="form-label fw-semibold">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('deskripsi_teks') is-invalid @enderror" 
                                      id="deskripsi_teks" name="deskripsi_teks" rows="4" 
                                      placeholder="Masukkan deskripsi jalur evakuasi" required>{{ old('deskripsi_teks') }}</textarea>
                            @error('deskripsi_teks')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Upload Gambar Jalur (Multiple) -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Gambar Jalur Evakuasi</label>
                            <input type="file" class="form-control @error('gambar_jalur') is-invalid @enderror"
                                   id="gambar_jalur" name="gambar_jalur[]" accept="image/*" multiple>
                            <small class="text-muted d-block mt-2">
                                Upload gambar jalur evakuasi. Format: JPEG, PNG, JPG, GIF, SVG. Maksimal 5MB per file. Bisa upload multiple gambar.
                            </small>
                            @error('gambar_jalur')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            @error('gambar_jalur.*')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            <!-- Preview Container -->
                            <div id="preview-container" class="mt-3 d-flex flex-wrap gap-2"></div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning fw-bold px-4">
                                Simpan
                            </button>
                            <a href="{{ route('admin.jalur-mitigasi.index') }}" class="btn btn-secondary fw-bold px-4">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Help Card -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">
                        Petunjuk Pengisian
                    </h6>
                    <ul class="small text-muted ps-3">
                        <li class="mb-2">Nama jalur harus jelas dan mudah dikenali</li>
                        <li class="mb-2">Assembly point adalah titik kumpul akhir</li>
                        <li class="mb-2">Deskripsi berisi instruksi jalur evakuasi</li>
                        <li class="mb-2">Upload gambar jalur evakuasi (opsional)</li>
                        <li>Bisa upload multiple gambar sekaligus</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('gambar_jalur');
    const previewContainer = document.getElementById('preview-container');
    
    // "Keranjang" untuk menampung semua file yang dipilih
    let fileDatastore = new DataTransfer();

    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const newFiles = this.files;
            
            // Masukkan file baru ke keranjang (cek duplikasi sederhana)
            for (let i = 0; i < newFiles.length; i++) {
                const file = newFiles[i];
                // Validasi ukuran (misal 5MB)
                if (file.size <= 5242880) { // 5MB in bytes
                    // Cek agar file yang sama persis tidak masuk 2x
                    let isDuplicate = false;
                    for (let j = 0; j < fileDatastore.files.length; j++) {
                        if (fileDatastore.files[j].name === file.name && 
                            fileDatastore.files[j].size === file.size) {
                            isDuplicate = true;
                            break;
                        }
                    }
                    if (!isDuplicate) {
                        fileDatastore.items.add(file);
                    }
                } else {
                    alert(`File ${file.name} terlalu besar (Max 5MB)`);
                }
            }

            // Update input asli dengan isi keranjang lengkap
            fileInput.files = fileDatastore.files;

            // Render ulang preview
            updatePreview();
        });
    }

    function updatePreview() {
        previewContainer.innerHTML = ''; // Reset tampilan
        const files = fileDatastore.files;

        if (files.length === 0) return;

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'position-relative';
                div.innerHTML = `
                    <img src="${e.target.result}" class="img-thumbnail" 
                         style="width: 120px; height: 120px; object-fit: cover;">
                    <button type="button" 
                            class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 p-0 px-2 rounded-circle remove-new-file" 
                            data-index="${i}" title="Hapus dari daftar upload"
                            style="line-height: 1;">
                        &times;
                    </button>
                    <div class="position-absolute top-0 start-0 bg-dark bg-opacity-75 text-white px-2 py-1 rounded-end" style="font-size: 0.7rem;">
                        ${i + 1}
                    </div>
                `;
                previewContainer.appendChild(div);
            }
            reader.readAsDataURL(file);
        }
    }

    // Event listener untuk tombol hapus (X) pada preview
    previewContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-new-file')) {
            const indexToRemove = parseInt(e.target.getAttribute('data-index'));
            
            // Buat keranjang baru
            const newDataTransfer = new DataTransfer();
            const currentFiles = fileDatastore.files;

            // Salin semua file KECUALI yang dihapus
            for (let i = 0; i < currentFiles.length; i++) {
                if (i !== indexToRemove) {
                    newDataTransfer.items.add(currentFiles[i]);
                }
            }

            // Simpan keranjang baru
            fileDatastore = newDataTransfer;
            fileInput.files = fileDatastore.files;
            
            // Update tampilan
            updatePreview();
        }
    });
});
</script>
@endsection