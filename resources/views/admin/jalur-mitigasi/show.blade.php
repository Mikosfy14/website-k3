@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Detail Jalur Mitigasi: {{ $jalur->nama_jalur }}</h1>
    <p><strong>Deskripsi:</strong> {{ $jalur->deskripsi_teks }}</p>
    <p><strong>Assembly Point:</strong> {{ $jalur->assembly_point }}</p>
    @if ($jalur->gambar_jalur_url)
        <img src="{{ $jalur->gambar_jalur_url }}" alt="Gambar Jalur" class="img-fluid mb-3">
    @endif
    <a href="{{ route('jalur-mitigasi.index') }}" class="btn btn-secondary">Kembali</a>
@endsection