@extends('layouts.dashboard')
@section('page_title', 'Dashboard Admin')

@section('dashboard_content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Card Statistik Buku -->
    <div class="glass-panel p-6 rounded-2xl shadow-sm border-l-4 border-nusantara-brown hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Buku</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalBuku }}</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center text-nusantara-brown text-xl">
                <i class="fa-solid fa-book"></i>
            </div>
        </div>
    </div>

    <!-- Card Statistik Anggota -->
    <div class="glass-panel p-6 rounded-2xl shadow-sm border-l-4 border-nusantara-gold hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Total Anggota</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalAnggota }}</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-yellow-100 flex items-center justify-center text-nusantara-gold text-xl">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>
    </div>

    <!-- Card Statistik Peminjaman Aktif -->
    <div class="glass-panel p-6 rounded-2xl shadow-sm border-l-4 border-red-700 hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Peminjaman Aktif</p>
                <h3 class="text-3xl font-bold text-gray-800">{{ $peminjamanAktif }}</h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center text-red-700 text-xl">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
        </div>
    </div>
</div>

<!-- Transaksi Terbaru -->
<div class="glass-panel rounded-2xl shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 bg-white/50 flex justify-between items-center">
        <h3 class="font-serif font-bold text-lg text-nusantara-dark">Transaksi Peminjaman Terbaru</h3>
        <a href="{{ url('admin/peminjaman') }}" class="text-sm text-nusantara-gold hover:text-nusantara-brown font-medium">Lihat Semua &rarr;</a>
    </div>
    <div class="p-0">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50/50 text-gray-500 text-sm border-b border-gray-100">
                    <th class="px-6 py-3 font-medium">Nama Peminjam</th>
                    <th class="px-6 py-3 font-medium">Buku</th>
                    <th class="px-6 py-3 font-medium">Tgl Pinjam</th>
                    <th class="px-6 py-3 font-medium">Status</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                @forelse($transaksiTerbaru as $transaksi)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $transaksi->anggota->nama_lengkap }}</td>
                    <td class="px-6 py-4">{{ $transaksi->buku->judul }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ \Carbon\Carbon::parse($transaksi->tgl_pinjam)->format('d M Y') }}</td>
                    <td class="px-6 py-4">
                        @if($transaksi->status == 'Dipinjam')
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-xs font-semibold">Dipinjam</span>
                        @else
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-semibold">Selesai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada transaksi peminjaman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
