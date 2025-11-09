@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Detail Lantai: {{ $lantai->nama_lantai }}</h1>
    <p><strong>Gedung:</strong> {{ $lantai->gedung->nama_gedung }}</p>
    <p><strong>Jalur Mitigasi:</strong> {{ $lantai->jalurMitigasi->nama_jalur }}</p>
    <a href="{{ route('lantai.index') }}" class="btn btn-secondary">Kembali</a>
@endsection