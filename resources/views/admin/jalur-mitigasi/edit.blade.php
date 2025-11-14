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
                    <form action="{{ route('admin.jalur-mitigasi.update', $jalur->id_jalur) }}" method="POST">
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

                        <!-- URL Gambar Jalur (Multiple) -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">URL Gambar Jalur (View 360)</label>
                            <div id="url-container">
                                @if(!empty($jalur->gambar_urls))
                                    @foreach($jalur->gambar_urls as $index => $url)
                                    <div class="input-group mb-2 url-input-group">
                                        <input type="url" class="form-control" 
                                               name="gambar_jalur_url[]" 
                                               placeholder="https://example.com/image.jpg" 
                                               value="{{ old('gambar_jalur_url.'.$index, $url) }}">
                                        <button type="button" class="btn btn-danger remove-url" {{ count($jalur->gambar_urls) == 1 ? 'disabled' : '' }}>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="input-group mb-2 url-input-group">
                                        <input type="url" class="form-control" name="gambar_jalur_url[]" placeholder="https://example.com/image.jpg">
                                        <button type="button" class="btn btn-danger remove-url" disabled>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                            </svg>
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary" id="add-url">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                </svg>
                                Tambah URL Gambar
                            </button>
                            <small class="text-muted d-block mt-2">Masukkan URL gambar untuk view 360. Anda bisa menambahkan beberapa gambar.</small>
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
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('url-container');
    const addButton = document.getElementById('add-url');

    // Add URL input
    addButton.addEventListener('click', function() {
        const newInput = document.createElement('div');
        newInput.className = 'input-group mb-2 url-input-group';
        newInput.innerHTML = `
            <input type="url" class="form-control" name="gambar_jalur_url[]" placeholder="https://example.com/image.jpg">
            <button type="button" class="btn btn-danger remove-url">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                </svg>
            </button>
        `;
        container.appendChild(newInput);
        updateRemoveButtons();
    });

    // Remove URL input
    container.addEventListener('click', function(e) {
        if (e.target.closest('.remove-url')) {
            e.target.closest('.url-input-group').remove();
            updateRemoveButtons();
        }
    });

    // Update remove button states
    function updateRemoveButtons() {
        const removeButtons = container.querySelectorAll('.remove-url');
        removeButtons.forEach(btn => {
            btn.disabled = removeButtons.length === 1;
        });
    }
});
</script>
@endsection