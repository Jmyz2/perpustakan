<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Peminjaman;
use App\Models\Buku;

class SiswaDashboardController extends Controller
{
    public function index()
    {
        $anggota = Auth::user()->anggota;
        
        $peminjamanAktif = 0;
        $riwayatPeminjaman = collect();
        
        if($anggota) {
            $peminjamanAktif = Peminjaman::where('id_anggota', $anggota->id_anggota)
                                        ->where('status', 'Dipinjam')
                                        ->count();
            
            $riwayatPeminjaman = Peminjaman::with('buku')
                                        ->where('id_anggota', $anggota->id_anggota)
                                        ->orderBy('created_at', 'desc')
                                        ->take(5)
                                        ->get();
        }

        $bukuTersedia = Buku::where('stok_buku', '>', 0)->count();

        return view('siswa.dashboard', compact('anggota', 'peminjamanAktif', 'riwayatPeminjaman', 'bukuTersedia'));
    }
}
