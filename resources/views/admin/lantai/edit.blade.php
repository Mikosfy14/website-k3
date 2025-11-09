@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Edit Lantai</h1>
    <form action="{{ route('lantai.update', $lantai->id_lantai) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="id_gedung" class="form-label">Gedung</label>
            <select name="id_gedung" id="id_gedung" class="form-select" required>
                @foreach ($gedungs as $gedung)
                    <option value="{{ $gedung->id_gedung }}" {{ $lantai->id_gedung == $gedung->id_gedung ? 'selected' : '' }}>{{ $gedung->nama_gedung }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="id_jalur" class="form-label">Jalur Mitigasi</label>
            <select name="id_jalur" id="id_jalur" class="form-select" required>
                @foreach ($jalurs as $jalur)
                    <option value="{{ $jalur->id_jalur }}" {{ $lantai->id_jalur == $jalur->id_jalur ? 'selected' : '' }}>{{ $jalur->nama_jalur }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="nama_lantai" class="form-label">Nama Lantai</label>
            <input type="text" name="nama_lantai" id="nama_lantai" class="form-control" value="{{ $lantai->nama_lantai }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('lantai.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection