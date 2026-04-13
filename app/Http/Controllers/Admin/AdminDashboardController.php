<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalBuku = Buku::count();
        $totalAnggota = Anggota::count();
        $peminjamanAktif = Peminjaman::where('status', 'Dipinjam')->count();
        
        // Ambil 5 transaksi terbaru
        $transaksiTerbaru = Peminjaman::with(['anggota', 'buku'])
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

        return view('admin.dashboard', compact('totalBuku', 'totalAnggota', 'peminjamanAktif', 'transaksiTerbaru'));
    }
}
