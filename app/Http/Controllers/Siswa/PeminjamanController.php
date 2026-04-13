<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function index()
    {
        $anggota = Auth::user()->anggota;
        
        $peminjaman = collect();
        if ($anggota) {
            $peminjaman = Peminjaman::with('buku')
                        ->where('id_anggota', $anggota->id_anggota)
                        ->orderBy('created_at', 'desc')
                        ->get();
        }

        return view('siswa.peminjaman.index', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        $anggota = Auth::user()->anggota;
        if (!$anggota) {
            return back()->withErrors(['Anda harus melengkapi profil anggota sebelum meminjam buku.']);
        }

        $request->validate([
            'id_buku' => 'required|exists:buku,id_buku',
        ]);

        // Cek limit peminjaman atau buku yang belum dikembalikan (opsional)
        $pinjamAktif = Peminjaman::where('id_anggota', $anggota->id_anggota)
                        ->where('status', 'Dipinjam')->count();
        
        if ($pinjamAktif >= 3) {
            return back()->withErrors(['Batas peminjaman maksimal 3 buku. Harap kembalikan buku sebelumnya.']);
        }

        $buku = Buku::findOrFail($request->id_buku);
        if ($buku->stok_buku <= 0) {
            return back()->withErrors(['Maaf, stok buku sedang habis.']);
        }

        Peminjaman::create([
            'id_anggota' => $anggota->id_anggota,
            'id_buku' => $request->id_buku,
            'tgl_pinjam' => Carbon::now(),
            'tgl_tenggat' => Carbon::now()->addDays(7),
            'status' => 'Dipinjam',
        ]);

        $buku->decrement('stok_buku');

        return redirect()->route('siswa.peminjaman.index')->with('success', 'Buku berhasil dipinjam! Silakan ambil di perpustakaan.');
    }

    public function kembalikan($id)
    {
        $anggota = Auth::user()->anggota;
        $peminjaman = Peminjaman::where('id_peminjaman', $id)
                    ->where('id_anggota', $anggota->id_anggota)
                    ->firstOrFail();
        
        if ($peminjaman->status == 'Dipinjam') {
            $peminjaman->update([
                'status' => 'Selesai',
                'tgl_dikembalikan' => Carbon::now()
            ]);

            $buku = Buku::findOrFail($peminjaman->id_buku);
            $buku->increment('stok_buku');

            return redirect()->route('siswa.peminjaman.index')->with('success', 'Buku berhasil dikembalikan. Terima kasih!');
        }

        return back();
    }
}
