@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Edit Gedung</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form action="{{ route('admin.gedung.update', $gedung->id_gedung) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="nama_gedung" class="form-label">Nama Gedung <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_gedung') is-invalid @enderror" 
                                       id="nama_gedung" name="nama_gedung" 
                                       value="{{ old('nama_gedung', $gedung->nama_gedung) }}" 
                                       placeholder="Masukkan nama gedung" required>
                                @error('nama_gedung')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="alamat_gedung" class="form-label">Alamat Gedung <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('alamat_gedung') is-invalid @enderror" 
                                          id="alamat_gedung" name="alamat_gedung" rows="3" 
                                          placeholder="Masukkan alamat lengkap gedung" required>{{ old('alamat_gedung', $gedung->alamat_gedung) }}</textarea>
                                @error('alamat_gedung')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="deskripsi_singkat" class="form-label">Deskripsi Singkat <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('deskripsi_singkat') is-invalid @enderror" 
                                          id="deskripsi_singkat" name="deskripsi_singkat" rows="4" 
                                          placeholder="Masukkan deskripsi singkat tentang gedung" required>{{ old('deskripsi_singkat', $gedung->deskripsi_singkat) }}</textarea>
                                @error('deskripsi_singkat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('admin.gedung.index') }}" class="btn btn-outline-secondary fw-bold px-4">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary fw-bold px-4">
                                Update Gedung
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection