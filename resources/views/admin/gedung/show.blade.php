@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Detail Gedung: {{ $gedung->nama_gedung }}</h1>
    <p><strong>Alamat:</strong> {{ $gedung->alamat_gedung }}</p>
    <p><strong>Deskripsi:</strong> {{ $gedung->deskripsi_singkat }}</p>
    <a href="{{ route('gedung.index') }}" class="btn btn-secondary">Kembali</a>
@endsection