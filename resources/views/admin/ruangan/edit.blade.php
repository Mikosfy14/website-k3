@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Edit Ruangan</h4>
                <a href="{{ route('admin.ruangan.index') }}" class="btn btn-outline-secondary">
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
                    <form action="{{ route('admin.ruangan.update', $ruangan->id_ruangan) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="id_lantai" class="form-label">Lantai <span class="text-danger">*</span></label>
                                <select class="form-select @error('id_lantai') is-invalid @enderror" 
                                        id="id_lantai" name="id_lantai" required>
                                    <option value="">Pilih Lantai</option>
                                    @foreach($lantais as $lantai)
                                        <option value="{{ $lantai->id_lantai }}" 
                                            {{ old('id_lantai', $ruangan->id_lantai) == $lantai->id_lantai ? 'selected' : '' }}>
                                            {{ $lantai->nama_lantai }} - {{ $lantai->gedung->nama_gedung }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_lantai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="kode_ruangan" class="form-label">Kode Ruangan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kode_ruangan') is-invalid @enderror" 
                                       id="kode_ruangan" name="kode_ruangan" 
                                       value="{{ old('kode_ruangan', $ruangan->kode_ruangan) }}" 
                                       placeholder="Contoh: R001, LAB-01, A101" required>
                                @error('kode_ruangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="nama_ruangan" class="form-label">Nama Ruangan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_ruangan') is-invalid @enderror" 
                                       id="nama_ruangan" name="nama_ruangan" 
                                       value="{{ old('nama_ruangan', $ruangan->nama_ruangan) }}" 
                                       placeholder="Contoh: Ruang Kelas 1, Laboratorium Komputer, Ruang Dosen" required>
                                @error('nama_ruangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('admin.ruangan.index') }}" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                    <path d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                </svg>
                                Update Ruangan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection