<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::latest()->get();
        return view('admin.buku.index', compact('buku'));
    }

    public function create()
    {
        return view('admin.buku.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_buku' => 'required|unique:buku,kode_buku',
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric',
            'stok_buku' => 'required|numeric'
        ]);

        Buku::create($validated);
        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Buku $buku)
    {
        return view('admin.buku.edit', compact('buku'));
    }

    public function update(Request $request, Buku $buku)
    {
        $validated = $request->validate([
            'kode_buku' => 'required|unique:buku,kode_buku,'.$buku->id_buku.',id_buku',
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric',
            'stok_buku' => 'required|numeric'
        ]);

        $buku->update($validated);
        return redirect()->route('buku.index')->with('success', 'Data Buku berhasil diupdate.');
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
    }
}
