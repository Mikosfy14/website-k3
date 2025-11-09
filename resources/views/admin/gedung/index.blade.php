@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Daftar Gedung</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('gedung.create') }}" class="btn btn-primary mb-3">Tambah Gedung</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Gedung</th>
                <th>Alamat</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gedungs as $gedung)
                <tr>
                    <td>{{ $gedung->nama_gedung }}</td>
                    <td>{{ $gedung->alamat_gedung }}</td>
                    <td>{{ $gedung->deskripsi_singkat }}</td>
                    <td>
                        <a href="{{ route('gedung.edit', $gedung->id_gedung) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('gedung.destroy', $gedung->id_gedung) }}" method="POST" style="display: inline;">
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