@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Detail Ruangan: {{ $ruangan->nama_ruangan }}</h1>
    <p><strong>Kode Ruangan:</strong> {{ $ruangan->kode_ruangan }}</p>
    <p><strong>Lantai:</strong> {{ $ruangan->lantai->nama_lantai }}</p>
    <a href="{{ route('ruangan.index') }}" class="btn btn-secondary">Kembali</a>
@endsection