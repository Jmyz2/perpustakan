@extends('layouts.dashboard')
@section('page_title', 'Halaman Utama Siswa')

@section('dashboard_content')
<div class="mb-8">
    <h2 class="text-2xl font-serif font-bold text-nusantara-brown mb-2">Selamat Datang, {{ $anggota->nama_lengkap ?? Auth::user()->name }}!</h2>
    <p class="text-gray-600">Jelajahi koleksi Pustaka Nusantara dan mulailah membaca hari ini.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <!-- Card Peminjaman Aktif -->
    <div class="glass-panel p-6 rounded-2xl shadow-sm border-l-4 border-nusantara-gold hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Buku Sedang Dipinjam</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $peminjamanAktif }}</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center text-nusantara-gold text-xl">
                <i class="fa-solid fa-book-reader"></i>
            </div>
        </div>
        <div class="mt-4 pt-4 border-t border-gray-100">
            <a href="{{ route('siswa.peminjaman.index') }}" class="text-sm text-nusantara-brown font-medium hover:underline">Lihat Detail Pinjaman &rarr;</a>
        </div>
    </div>

    <!-- Card Buku Tersedia -->
    <div class="glass-panel p-6 rounded-2xl shadow-sm border-l-4 border-nusantara-brown hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Koleksi Buku Tersedia</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $bukuTersedia }}</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center text-nusantara-brown text-xl">
                <i class="fa-solid fa-layer-group"></i>
            </div>
        </div>
         <div class="mt-4 pt-4 border-t border-gray-100">
            <a href="{{ route('siswa.buku.index') }}" class="text-sm text-nusantara-brown font-medium hover:underline">Jelajahi Katalog Buku &rarr;</a>
        </div>
    </div>
</div>

<!-- Riwayat Terbaru -->
<div class="glass-panel rounded-2xl shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 bg-white/50">
        <h3 class="font-serif font-bold text-lg text-nusantara-dark">Aktivitas Terakhir Anda</h3>
    </div>
    <div class="p-0">
        <table class="w-full text-left border-collapse">
            <tbody class="text-sm divide-y divide-gray-100">
                @forelse($riwayatPeminjaman as $transaksi)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4">
                        <p class="font-medium text-gray-800">{{ $transaksi->buku->judul ?? '-' }}</p>
                    </td>
                    <td class="px-6 py-4 text-gray-500 hidden md:table-cell">
                        Dipinjam pada: {{ \Carbon\Carbon::parse($transaksi->tgl_pinjam)->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        @if($transaksi->status == 'Dipinjam')
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs font-semibold">Sedang Dipinjam</span>
                        @else
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-semibold">Dikembalikan</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-8 text-center text-gray-500">Anda belum memiliki riwayat peminjaman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
