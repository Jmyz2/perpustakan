<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::where('stok_buku', '>', 0)->latest()->get();
        return view('siswa.buku.index', compact('buku'));
    }
}
