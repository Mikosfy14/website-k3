@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Tambah Gedung Baru</h4>
                <a href="{{ route('admin.gedung.index') }}" class="btn btn-outline-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.gedung.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="nama_gedung" class="form-label">Nama Gedung <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_gedung') is-invalid @enderror" 
                                       id="nama_gedung" name="nama_gedung" value="{{ old('nama_gedung') }}" 
                                       placeholder="Masukkan nama gedung" required>
                                @error('nama_gedung')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="alamat_gedung" class="form-label">Alamat Gedung <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('alamat_gedung') is-invalid @enderror" 
                                          id="alamat_gedung" name="alamat_gedung" rows="3" 
                                          placeholder="Masukkan alamat lengkap gedung" required>{{ old('alamat_gedung') }}</textarea>
                                @error('alamat_gedung')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="deskripsi_singkat" class="form-label">Deskripsi Singkat <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('deskripsi_singkat') is-invalid @enderror" 
                                          id="deskripsi_singkat" name="deskripsi_singkat" rows="4" 
                                          placeholder="Masukkan deskripsi singkat tentang gedung" required>{{ old('deskripsi_singkat') }}</textarea>
                                @error('deskripsi_singkat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('admin.gedung.index') }}" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                    <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v4.5h2a.5.5 0 0 1 .354.146l1.853 1.854A.5.5 0 0 1 13 9.5h.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5V11h-2a.5.5 0 0 1-.5-.5V9H5.5A1.5 1.5 0 0 1 4 7.5V5H2a1 1 0 0 0-1 1"/>
                                </svg>
                                Simpan Gedung
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection