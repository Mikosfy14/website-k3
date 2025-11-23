@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.jalur-mitigasi.index') }}">Jalur Evakuasi</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4">
                    <h5 class="mb-0 fw-bold">Edit Jalur Evakuasi</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.jalur-mitigasi.update', $jalur->id_jalur) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nama Jalur -->
                        <div class="mb-4">
                            <label for="nama_jalur" class="form-label fw-semibold">Nama Jalur <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_jalur') is-invalid @enderror" 
                                   id="nama_jalur" name="nama_jalur" 
                                   value="{{ old('nama_jalur', $jalur->nama_jalur) }}" 
                                   placeholder="Contoh: Jalur Evakuasi Utara" required>
                            @error('nama_jalur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Assembly Point -->
                        <div class="mb-4">
                            <label for="assembly_point" class="form-label fw-semibold">Assembly Point <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('assembly_point') is-invalid @enderror" 
                                   id="assembly_point" name="assembly_point" 
                                   value="{{ old('assembly_point', $jalur->assembly_point) }}" 
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
                                      placeholder="Masukkan deskripsi jalur evakuasi" required>{{ old('deskripsi_teks', $jalur->deskripsi_teks) }}</textarea>
                            @error('deskripsi_teks')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if(!empty($jalur->gambar_urls) && count($jalur->gambar_urls) > 0)
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Gambar Saat Ini</label>
                            <div class="d-flex flex-wrap gap-2" id="existing-images">
                                @foreach($jalur->gambar_urls as $index => $imagePath)
                                <div class="position-relative existing-image-item" id="image-{{ $index }}" data-path="{{ $imagePath }}">
                                    <img src="{{ asset('storage/' . $imagePath) }}"
                                        class="img-thumbnail"
                                        style="width: 120px; height: 120px; object-fit: cover;">
                                    <button type="button" 
                                            class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 delete-image-btn"
                                            data-image-path="{{ $imagePath }}"
                                            data-jalur-id="{{ $jalur->id_jalur }}"
                                            data-index="{{ $index }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                                        </svg>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Upload Gambar Baru -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Upload Gambar Baru</label>
                            <input type="file" class="form-control @error('gambar_jalur') is-invalid @enderror"
                                   id="gambar_jalur" name="gambar_jalur[]" accept="image/*" multiple>
                            <small class="text-muted d-block mt-2">
                                Upload gambar jalur evakuasi. Format: JPEG, PNG, JPG, GIF, SVG. Maksimal 5MB per file.
                            </small>
                            @error('gambar_jalur')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            <!-- Preview Container for New Images -->
                            <div id="preview-container" class="mt-3 d-flex flex-wrap gap-2"></div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                                </svg>
                                Update
                            </button>
                            <a href="{{ route('admin.jalur-mitigasi.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Info Card -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                        </svg>
                        Informasi
                    </h6>
                    <div class="small text-muted">
                        <div class="mb-2">
                            <strong>Dibuat:</strong><br>
                            {{ $jalur->created_at->format('d M Y H:i') }}
                        </div>
                        <div>
                            <strong>Terakhir Update:</strong><br>
                            {{ $jalur->updated_at->format('d M Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Simple direct event binding
function initDeleteButtons() {
    console.log('🔄 Initializing delete buttons...');
    
    const deleteButtons = document.querySelectorAll('.delete-image-btn');
    console.log('🔘 Found delete buttons:', deleteButtons.length);
    
    deleteButtons.forEach(button => {
        // Remove existing event listeners to avoid duplicates
        button.replaceWith(button.cloneNode(true));
    });
    
    // Re-select buttons after clone
    const freshButtons = document.querySelectorAll('.delete-image-btn');
    
    freshButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            console.log('Delete button clicked directly!', this);
            
            const imagePath = this.dataset.imagePath;
            const jalurId = this.dataset.jalurId;
            const index = this.dataset.index;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            console.log('Button data:', { jalurId, imagePath, index });

            if (confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
                console.log('Confirmed, sending request...');
                
                // Show loading
                const originalHTML = this.innerHTML;
                this.innerHTML = `
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                `;
                this.disabled = true;

                // Send request
                fetch(`/admin/jalur-mitigasi/${jalurId}/delete-image`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({ image_path: imagePath })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Response:', data);
                    if (data.success) {
                        // Remove image element
                        const imageElement = document.getElementById(`image-${index}`);
                        if (imageElement) {
                            imageElement.remove();
                            showAlert('Gambar berhasil dihapus!', 'success');
                        }
                    } else {
                        showAlert('' + data.message, 'danger');
                        this.innerHTML = originalHTML;
                        this.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showAlert('Terjadi kesalahan', 'danger');
                    this.innerHTML = originalHTML;
                    this.disabled = false;
                });
            }
        });
    });
}

// Simple alert function
function showAlert(message, type) {
    // Remove existing alerts
    const existingAlert = document.querySelector('.ajax-alert');
    if (existingAlert) existingAlert.remove();

    // Create new alert
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show ajax-alert mt-3`;
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    // Insert at top of card body
    const cardBody = document.querySelector('.card-body');
    if (cardBody) {
        cardBody.insertBefore(alertDiv, cardBody.firstChild);
    }
}

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Page loaded, initializing...');
    initDeleteButtons();
});

// Also try initializing after a short delay (in case of dynamic content)
setTimeout(initDeleteButtons, 100);
</script>
@endsection