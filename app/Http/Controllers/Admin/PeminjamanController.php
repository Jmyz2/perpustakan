<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Anggota;
use App\Models\Buku;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with(['anggota', 'buku'])->latest()->get();
        return view('admin.peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $anggota = Anggota::all();
        $buku = Buku::where('stok_buku', '>', 0)->get();
        return view('admin.peminjaman.create', compact('anggota', 'buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_anggota' => 'required|exists:anggota,id_anggota',
            'id_buku' => 'required|exists:buku,id_buku',
        ]);

        $buku = Buku::findOrFail($request->id_buku);
        if ($buku->stok_buku <= 0) {
            return back()->withErrors(['id_buku' => 'Stok buku habis.']);
        }

        Peminjaman::create([
            'id_anggota' => $request->id_anggota,
            'id_buku' => $request->id_buku,
            'tgl_pinjam' => Carbon::now(),
            'tgl_tenggat' => Carbon::now()->addDays(7),
            'status' => 'Dipinjam',
        ]);

        // Kurangi stok buku
        $buku->decrement('stok_buku');

        return redirect()->route('peminjaman.index')->with('success', 'Transaksi Peminjaman berhasil ditambahkan.');
    }

    // Custom method to return book
    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        if ($peminjaman->status == 'Dipinjam') {
            $peminjaman->update([
                'status' => 'Selesai',
                'tgl_dikembalikan' => Carbon::now()
            ]);

            // Kembalikan stok buku
            $buku = Buku::findOrFail($peminjaman->id_buku);
            $buku->increment('stok_buku');

            return redirect()->route('peminjaman.index')->with('success', 'Buku berhasil dikembalikan. Stok telah diupdate.');
        }

        return redirect()->route('peminjaman.index')->withErrors(['Peminjaman ini sudah selesai/dikembalikan.']);
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        // Kasus: jika dihapus saat status masih dipinjam, apakah stok dibalik?
        if($peminjaman->status == 'Dipinjam') {
            $buku = Buku::findOrFail($peminjaman->id_buku);
            $buku->increment('stok_buku');
        }

        $peminjaman->delete();
        return redirect()->route('peminjaman.index')->with('success', 'Data Transaksi berhasil dihapus.');
    }
}
