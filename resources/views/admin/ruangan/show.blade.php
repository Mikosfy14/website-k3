@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Detail Ruangan</h4>
                <a href="{{ route('admin.ruangan.index') }}" class="btn btn-outline-secondary fw-bold px-4">
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="card-title mb-4">{{ $ruangan->nama_ruangan }}</h5>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h6 class="text-muted mb-2">Kode Ruangan</h6>
                                    <p class="mb-0">
                                        <span class="badge bg-secondary fs-6">{{ $ruangan->kode_ruangan }}</span>
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted mb-2">Lantai</h6>
                                    <p class="mb-0">
                                        <span class="badge bg-primary">{{ $ruangan->lantai->nama_lantai }}</span>
                                    </p>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h6 class="text-muted mb-2">Gedung</h6>
                                    <p class="mb-0">{{ $ruangan->lantai->gedung->nama_gedung }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-muted mb-2">Jalur Evakuasi</h6>
                                    <p class="mb-0">
                                        <span class="badge bg-success">{{ $ruangan->lantai->jalurMitigasi->nama_jalur }}</span>
                                    </p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h6 class="text-muted mb-2">Alamat Gedung</h6>
                                <p class="mb-0">{{ $ruangan->lantai->gedung->alamat_gedung }}</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card bg-light border-0">
                                <div class="card-body">
                                    <h6 class="text-muted mb-3">Informasi</h6>
                                    <div class="mb-2">
                                        <small class="text-muted">ID Ruangan</small>
                                        <p class="mb-0 fw-semibold">#{{ $ruangan->id_ruangan }}</p>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Dibuat</small>
                                        <p class="mb-0">{{ $ruangan->created_at->format('d M Y H:i') }}</p>
                                    </div>
                                    <div class="mb-2">
                                        <small class="text-muted">Diupdate</small>
                                        <p class="mb-0">{{ $ruangan->updated_at->format('d M Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-top">
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.ruangan.edit', $ruangan->id_ruangan) }}" class="btn btn-warning fw-bold px-4">
                                Edit
                            </a>
                            <form action="{{ route('admin.ruangan.destroy', $ruangan->id_ruangan) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger fw-bold px-4" onclick="return confirm('Yakin ingin menghapus ruangan ini?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection