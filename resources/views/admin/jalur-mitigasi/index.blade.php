@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Daftar Jalur Mitigasi</h1>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('jalur-mitigasi.create') }}" class="btn btn-primary mb-3">Tambah Jalur</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Jalur</th>
                <th>Deskripsi</th>
                <th>Assembly Point</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jalurs as $jalur)
                <tr>
                    <td>{{ $jalur->nama_jalur }}</td>
                    <td>{{ $jalur->deskripsi_teks }}</td>
                    <td>{{ $jalur->assembly_point }}</td>
                    <td>
                        <a href="{{ route('jalur-mitigasi.edit', $jalur->id_jalur) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('jalur-mitigasi.destroy', $jalur->id_jalur) }}" method="POST" style="display: inline;">
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