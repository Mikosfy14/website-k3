@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Jalur Evakuasi untuk {{ $lantai->nama_lantai }} @if($ruanganInput) (dari {{ $ruanganInput }}) @endif</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nama Jalur: {{ $jalur->nama_jalur }}</h5>
            <p class="card-text"><strong>Deskripsi:</strong> {{ $jalur->deskripsi_teks }}</p>
            <p class="card-text"><strong>Assembly Point:</strong> {{ $jalur->assembly_point }}</p>
            @if ($jalur->gambar_jalur_url)
                <img src="{{ $jalur->gambar_jalur_url }}" alt="Gambar Jalur" class="img-fluid mb-3">
            @endif
        </div>
    </div>
    <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Kembali ke Pencarian</a>
@endsection