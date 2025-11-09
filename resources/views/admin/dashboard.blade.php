@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Welcome Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-light) 100%);">
                <div class="card-body text-white p-4">
                    <h2 class="mb-2">Dashboard Admin K3</h2>
                    <p class="mb-0 opacity-75">Selamat datang di Sistem Manajemen Keselamatan dan Kesehatan Kerja</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <!-- Gedung Card -->
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100 hover-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 rounded-3 p-3" style="background-color: rgba(0, 51, 102, 0.1);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="var(--color-primary)" viewBox="0 0 16 16">
                                <path d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5m.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935"/>
                            </svg>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1 text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Total Gedung</h6>
                            <h2 class="mb-0 fw-bold" style="color: var(--color-primary);">{{ $stats['gedung'] }}</h2>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.gedung.index') }}" class="btn btn-sm btn-outline-primary">
                            Kelola Gedung
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lantai Card -->
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100 hover-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 rounded-3 p-3" style="background-color: rgba(255, 179, 0, 0.1);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="var(--color-secondary)" viewBox="0 0 16 16">
                                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z"/>
                            </svg>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1 text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Total Lantai</h6>
                            <h2 class="mb-0 fw-bold" style="color: var(--color-secondary);">{{ $stats['lantai'] }}</h2>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.lantai.index') }}" class="btn btn-sm" style="color: var(--color-secondary); border-color: var(--color-secondary);">
                            Kelola Lantai
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jalur Mitigasi Card -->
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100 hover-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 rounded-3 p-3" style="background-color: rgba(40, 167, 69, 0.1);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#28a745" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5m14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5"/>
                            </svg>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1 text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Jalur Evakuasi</h6>
                            <h2 class="mb-0 fw-bold text-success">{{ $stats['jalur'] }}</h2>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.jalur-mitigasi.index') }}" class="btn btn-sm btn-outline-success">
                            Kelola Jalur
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ruangan Card -->
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100 hover-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 rounded-3 p-3" style="background-color: rgba(220, 53, 69, 0.1);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#dc3545" viewBox="0 0 16 16">
                                <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5"/>
                            </svg>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="text-muted mb-1 text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.5px;">Total Ruangan</h6>
                            <h2 class="mb-0 fw-bold text-danger">{{ $stats['ruangan'] }}</h2>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('admin.ruangan.index') }}" class="btn btn-sm btn-outline-danger">
                            Kelola Ruangan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4">
                    <h5 class="mb-0 fw-bold">Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="{{ route('admin.gedung.create') }}" class="btn btn-outline-primary w-100 py-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="mb-2" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                </svg>
                                <div>Tambah Gedung</div>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.jalur-mitigasi.create') }}" class="btn w-100 py-3 text-white" style="background-color: var(--color-secondary);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="mb-2" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                </svg>
                                <div>Tambah Jalur</div>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.lantai.create') }}" class="btn btn-outline-success w-100 py-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="mb-2" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                </svg>
                                <div>Tambah Lantai</div>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.ruangan.create') }}" class="btn btn-outline-danger w-100 py-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="mb-2" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                </svg>
                                <div>Tambah Ruangan</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Section -->
    <div class="row">
        
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4">
                    <h5 class="mb-0 fw-bold">Bantuan</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">Kelola data gedung, lantai, jalur evakuasi, dan ruangan dari menu navigasi di sebelah kiri.</p>
                    <div class="d-grid gap-2">
                        <a href="/" class="btn btn-outline-secondary" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                                <path d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
                            </svg>
                            Lihat Landing Page
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-card {
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }
</style>
@endsection
