@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Tambah Ruangan</h1>
    <form action="{{ route('ruangan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_lantai" class="form-label">Lantai</label>
            <select name="id_lantai" id="id_lantai" class="form-select" required>
                @foreach ($lantais as $lantai)
                    <option value="{{ $lantai->id_lantai }}">{{ $lantai->nama_lantai }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
            <input type="text" name="nama_ruangan" id="nama_ruangan" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="kode_ruangan" class="form-label">Kode Ruangan</label>
            <input type="text" name="kode_ruangan" id="kode_ruangan" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('ruangan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection