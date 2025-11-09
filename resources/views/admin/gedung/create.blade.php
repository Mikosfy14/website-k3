@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Tambah Gedung</h1>
    <form action="{{ route('gedung.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_gedung" class="form-label">Nama Gedung</label>
            <input type="text" name="nama_gedung" id="nama_gedung" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="alamat_gedung" class="form-label">Alamat</label>
            <textarea name="alamat_gedung" id="alamat_gedung" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label for="deskripsi_singkat" class="form-label">Deskripsi Singkat</label>
            <textarea name="deskripsi_singkat" id="deskripsi_singkat" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('gedung.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection