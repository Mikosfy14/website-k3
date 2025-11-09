@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Daftar Ruangan</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('ruangan.create') }}" class="btn btn-primary mb-3">Tambah Ruangan</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Ruangan</th>
                <th>Kode Ruangan</th>
                <th>Lantai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ruangans as $ruangan)
                <tr>
                    <td>{{ $ruangan->nama_ruangan }}</td>
                    <td>{{ $ruangan->kode_ruangan }}</td>
                    <td>{{ $ruangan->lantai->nama_lantai }}</td>
                    <td>
                        <a href="{{ route('ruangan.edit', $ruangan->id_ruangan) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('ruangan.destroy', $ruangan->id_ruangan) }}" method="POST" style="display: inline;">
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