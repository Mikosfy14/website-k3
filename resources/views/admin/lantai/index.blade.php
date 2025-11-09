@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Daftar Lantai</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('lantai.create') }}" class="btn btn-primary mb-3">Tambah Lantai</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Lantai</th>
                <th>Gedung</th>
                <th>Jalur Mitigasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lantais as $lantai)
                <tr>
                    <td>{{ $lantai->nama_lantai }}</td>
                    <td>{{ $lantai->gedung->nama_gedung }}</td>
                    <td>{{ $lantai->jalurMitigasi->nama_jalur }}</td>
                    <td>
                        <a href="{{ route('lantai.edit', $lantai->id_lantai) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('lantai.destroy', $lantai->id_lantai) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection