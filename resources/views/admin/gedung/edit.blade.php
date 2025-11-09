@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Edit Gedung</h1>
    <form action="{{ route('gedung.update', $gedung->id_gedung) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_gedung" class="form-label">Nama Gedung</label>
            <input type="text" name="nama_gedung" id="nama_gedung" class="form-control" value="{{ $gedung->nama_gedung }}" required>
        </div>
        <div class="mb-3">
            <label for="alamat_gedung" class="form-label">Alamat</label>
            <textarea name="alamat_gedung" id="alamat_gedung" class="form-control" required>{{ $gedung->alamat_gedung }}</textarea>
        </div>
        <div class="mb-3">
            <label for="deskripsi_singkat" class="form-label">Deskripsi Singkat</label>
            <textarea name="deskripsi_singkat" id="deskripsi_singkat" class="form-control" required>{{ $gedung->deskripsi_singkat }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('gedung.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection