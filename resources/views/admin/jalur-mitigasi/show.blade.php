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
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Detail Jalur Evakuasi</h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.jalur-mitigasi.edit', $jalur->id_jalur) }}" class="btn btn-sm btn-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('admin.jalur-mitigasi.destroy', $jalur->id_jalur) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus jalur ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
                <div class="card-body p-4">
                    <!-- Nama Jalur -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted small">NAMA JALUR</label>
                        <p class="fs-5 mb-0">{{ $jalur->nama_jalur }}</p>
                    </div>

                    <hr>

                    <!-- Assembly Point -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted small">ASSEMBLY POINT</label>
                        <p class="mb-0">
                            <span class="badge bg-success fs-6 px-3 py-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                                </svg>
                                {{ $jalur->assembly_point }}
                            </span>
                        </p>
                    </div>

                    <hr>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted small">DESKRIPSI</label>
                        <p class="mb-0">{{ $jalur->deskripsi_teks }}</p>
                    </div>

                    <hr>

                    <!-- Gambar Jalur -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-muted small">GAMBAR JALUR EVAKUASI</label>
                        @if(!empty($jalur->gambar_urls))
                            <div class="row g-3">
                                @foreach($jalur->gambar_urls as $index => $imagePath)
                                <div class="col-md-6">
                                    <div class="card">
                                        <img src="{{ asset('storage/' . $imagePath) }}"
                                             class="card-img-top"
                                             alt="Gambar Jalur {{ $index + 1 }}"
                                             style="height: 200px; object-fit: cover;">
                                        <div class="card-body">
                                            <p class="card-text text-muted small mb-2">Gambar {{ $index + 1 }}</p>
                                            <a href="{{ asset('storage/' . $imagePath) }}"
                                               target="_blank"
                                               class="btn btn-sm btn-outline-primary w-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                                    <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                                                    <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                                                </svg>
                                                Lihat Penuh
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted mb-0">Belum ada gambar jalur</p>
                        @endif
                    </div>

                    <hr>

                    <!-- Metadata -->
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">DIBUAT PADA</label>
                            <p class="mb-0">{{ $jalur->created_at->format('d F Y, H:i') }} WIB</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-muted small">TERAKHIR DIUPDATE</label>
                            <p class="mb-0">{{ $jalur->updated_at->format('d F Y, H:i') }} WIB</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 pb-4">
                    <a href="{{ route('admin.jalur-mitigasi.index') }}" class="btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistics Card -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                            <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5z"/>
                        </svg>
                        Informasi Jalur
                    </h6>
                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded mb-2">
                        <span class="text-muted">Total Gambar</span>
                        <span class="fw-bold fs-5 text-warning">{{ !empty($jalur->gambar_urls) ? count($jalur->gambar_urls) : 0 }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                        <span class="text-muted">Lantai Terkait</span>
                        <span class="fw-bold fs-5 text-primary">{{ $jalur->lantais->count() ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection