@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Tambah Lantai</h1>
    <form action="{{ route('lantai.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="id_gedung" class="form-label">Gedung</label>
            <select name="id_gedung" id="id_gedung" class="form-select" required>
                @foreach ($gedungs as $gedung)
                    <option value="{{ $gedung->id_gedung }}">{{ $gedung->nama_gedung }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="id_jalur" class="form-label">Jalur Mitigasi</label>
            <select name="id_jalur" id="id_jalur" class="form-select" required>
                @foreach ($jalurs as $jalur)
                    <option value="{{ $jalur->id_jalur }}">{{ $jalur->nama_jalur }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="nama_lantai" class="form-label">Nama Lantai</label>
            <input type="text" name="nama_lantai" id="nama_lantai" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('lantai.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection