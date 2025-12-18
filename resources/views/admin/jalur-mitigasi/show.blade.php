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
                        <a href="{{ route('admin.jalur-mitigasi.edit', $jalur->id_jalur) }}" class="btn btn-sm btn-warning fw-bold px-4">
                            Edit
                        </a>
                        <form action="{{ route('admin.jalur-mitigasi.destroy', $jalur->id_jalur) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus jalur ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger fw-bold px-4">
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
                            <span class="badge bg-success fs-6 px-3 py-2 d-inline-flex align-items-center gap-2">
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
                                               class="btn btn-sm btn-outline-primary w-100 fw-bold px-4">
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
                    <a href="{{ route('admin.jalur-mitigasi.index') }}" class="btn btn-secondary fw-bold px-4">
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