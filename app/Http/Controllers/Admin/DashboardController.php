<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gedung;
use App\Models\Lantai;
use App\Models\JalurMitigasi;
use App\Models\Ruangan;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'gedung' => Gedung::count(),
            'lantai' => Lantai::count(),
            'jalur' => JalurMitigasi::count(),
            'ruangan' => Ruangan::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
