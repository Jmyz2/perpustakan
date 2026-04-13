@extends('layouts.dashboard')
@section('page_title', 'Tambah Transaksi Peminjaman')

@section('dashboard_content')
<div class="mb-6">
    <a href="{{ route('peminjaman.index') }}" class="text-nusantara-brown hover:text-nusantara-dark transition-colors">
        <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Daftar Transaksi
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

    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Pilih Anggota</label>
                <select name="id_anggota" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold bg-white" required>
                    <option value="">-- Pilih Siswa / Anggota --</option>
                    @foreach($anggota as $item)
                        <option value="{{ $item->id_anggota }}">{{ $item->nis }} - {{ $item->nama_lengkap }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Pilih Buku</label>
                <select name="id_buku" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold bg-white" required>
                    <option value="">-- Pilih Buku Tersedia --</option>
                    @foreach($buku as $item)
                        <option value="{{ $item->id_buku }}">{{ $item->kode_buku }} - {{ $item->judul }} (Stok: {{ $item->stok_buku }})</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="bg-blue-50 text-blue-800 p-4 rounded-lg mb-6 text-sm">
            <i class="fa-solid fa-circle-info mr-1"></i>
            Tanggal Pinjam diset hari ini. Tenggat pengembalian otomatis diset 7 hari dari sekarang.
        </div>
        
        <div class="flex justify-end">
            <button class="bg-nusantara-brown hover:bg-nusantara-dark text-white font-bold py-2 px-6 rounded-lg transition-colors shadow-sm" type="submit">
                Proses Peminjaman
            </button>
        </div>
    </form>
</div>
@endsection
