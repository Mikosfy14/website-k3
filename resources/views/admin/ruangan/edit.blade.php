@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Edit Ruangan</h1>
    <form action="{{ route('ruangan.update', $ruangan->id_ruangan) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="id_lantai" class="form-label">Lantai</label>
            <select name="id_lantai" id="id_lantai" class="form-select" required>
                @foreach ($lantais as $lantai)
                    <option value="{{ $lantai->id_lantai }}" {{ $ruangan->id_lantai == $lantai->id_lantai ? 'selected' : '' }}>{{ $lantai->nama_lantai }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
            <input type="text" name="nama_ruangan" id="nama_ruangan" class="form-control" value="{{ $ruangan->nama_ruangan }}" required>
        </div>
        <div class="mb-3">
            <label for="kode_ruangan" class="form-label">Kode Ruangan</label>
            <input type="text" name="kode_ruangan" id="kode_ruangan" class="form-control" value="{{ $ruangan->kode_ruangan }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('ruangan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection