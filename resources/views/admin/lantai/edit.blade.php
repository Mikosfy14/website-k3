@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Edit Lantai</h4>
                <a href="{{ route('admin.lantai.index') }}" class="btn btn-outline-secondary">
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
                    <form action="{{ route('admin.lantai.update', $lantai->id_lantai) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="id_gedung" class="form-label">Gedung <span class="text-danger">*</span></label>
                                <select class="form-select @error('id_gedung') is-invalid @enderror" 
                                        id="id_gedung" name="id_gedung" required>
                                    <option value="">Pilih Gedung</option>
                                    @foreach($gedungs as $gedung)
                                        <option value="{{ $gedung->id_gedung }}" 
                                            {{ old('id_gedung', $lantai->id_gedung) == $gedung->id_gedung ? 'selected' : '' }}>
                                            {{ $gedung->nama_gedung }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_gedung')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="id_jalur" class="form-label">Jalur Mitigasi <span class="text-danger">*</span></label>
                                <select class="form-select @error('id_jalur') is-invalid @enderror" 
                                        id="id_jalur" name="id_jalur" required>
                                    <option value="">Pilih Jalur Mitigasi</option>
                                    @foreach($jalurs as $jalur)
                                        <option value="{{ $jalur->id_jalur }}" 
                                            {{ old('id_jalur', $lantai->id_jalur) == $jalur->id_jalur ? 'selected' : '' }}>
                                            {{ $jalur->nama_jalur }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_jalur')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="nama_lantai" class="form-label">Nama Lantai <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_lantai') is-invalid @enderror" 
                                       id="nama_lantai" name="nama_lantai" 
                                       value="{{ old('nama_lantai', $lantai->nama_lantai) }}" 
                                       placeholder="Contoh: Lantai 1, Basement, Lantai Dasar" required>
                                @error('nama_lantai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('admin.lantai.index') }}" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                    <path d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                </svg>
                                Update Lantai
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection