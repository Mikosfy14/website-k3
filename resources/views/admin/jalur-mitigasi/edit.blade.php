@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Edit Jalur Mitigasi</h1>
    <form action="{{ route('jalur-mitigasi.update', $jalur->id_jalur) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_jalur" class="form-label">Nama Jalur</label>
            <input type="text" name="nama_jalur" id="nama_jalur" class="form-control" value="{{ $jalur->nama_jalur }}" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi_teks" class="form-label">Deskripsi</label>
            <textarea name="deskripsi_teks" id="deskripsi_teks" class="form-control" required>{{ $jalur->deskripsi_teks }}</textarea>
        </div>
        <div class="mb-3">
            <label for="gambar_jalur_url" class="form-label">URL Gambar Jalur (opsional)</label>
            <input type="url" name="gambar_jalur_url" id="gambar_jalur_url" class="form-control" value="{{ $jalur->gambar_jalur_url }}">
        </div>
        <div class="mb-3">
            <label for="assembly_point" class="form-label">Assembly Point</label>
            <input type="text" name="assembly_point" id="assembly_point" class="form-control" value="{{ $jalur->assembly_point }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('jalur-mitigasi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection