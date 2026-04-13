@extends('layouts.dashboard')
@section('page_title', 'Tambah Buku Baru')

@section('dashboard_content')
<div class="mb-6">
    <a href="{{ route('buku.index') }}" class="text-nusantara-brown hover:text-nusantara-dark transition-colors">
        <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Daftar Buku
    </a>
</div>

<div class="glass-panel p-8 rounded-2xl shadow-sm max-w-3xl bg-white">
    @if ($errors->any())
        <div class="bg-red-50 text-red-500 p-4 rounded-lg mb-6 border border-red-200">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('buku.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Kode Buku</label>
                <input class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold" type="text" name="kode_buku" value="{{ old('kode_buku') }}" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Judul Buku</label>
                <input class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold" type="text" name="judul" value="{{ old('judul') }}" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Pengarang</label>
                <input class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold" type="text" name="pengarang" value="{{ old('pengarang') }}" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Penerbit</label>
                <input class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold" type="text" name="penerbit" value="{{ old('penerbit') }}" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Tahun Terbit</label>
                <input class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold" type="number" name="tahun_terbit" value="{{ old('tahun_terbit') }}" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Stok Tersedia</label>
                <input class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold" type="number" name="stok_buku" value="{{ old('stok_buku') }}" required>
            </div>
        </div>
        
        <div class="flex justify-end">
            <button class="bg-nusantara-brown hover:bg-nusantara-dark text-white font-bold py-2 px-6 rounded-lg transition-colors shadow-sm" type="submit">
                Simpan Data
            </button>
        </div>
    </form>
</div>
@endsection
