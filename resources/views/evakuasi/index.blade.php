@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Cari Jalur Evakuasi</h1>
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <form action="{{ route('cari.evakuasi') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label for="lantai" class="form-label">Lantai (contoh: Lantai 5)</label>
            <input type="text" name="lantai" id="lantai" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="ruangan" class="form-label">Ruangan (opsional, contoh: Ruang Meeting A)</label>
            <input type="text" name="ruangan" id="ruangan" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Cari Jalur</button>
    </form>
@endsection