@extends('layouts.dashboard')
@section('page_title', 'Riwayat Peminjaman Buku')

@section('dashboard_content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-xl font-serif font-bold text-nusantara-dark">Buku yang Pernah Kamu Pinjam</h2>
    <a href="{{ route('siswa.buku.index') }}" class="text-nusantara-gold hover:text-nusantara-brown transition-colors text-sm font-medium">
        &larr; Lanjut Cari Buku
    </a>
</div>

@if(session('success'))
<div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 border border-green-200">
    <i class="fa-solid fa-check-circle mr-2"></i> {{ session('success') }}
</div>
@endif

@if($errors->any())
<div class="bg-red-50 text-red-500 p-4 rounded-lg mb-6 border border-red-200">
    <ul class="list-disc pl-5">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="glass-panel overflow-hidden rounded-2xl shadow-sm">
    <table class="w-full text-left">
        <thead class="bg-nusantara-brown text-white">
            <tr>
                <th class="px-6 py-4 font-medium">Buku</th>
                <th class="px-6 py-4 font-medium">Detail Waktu</th>
                <th class="px-6 py-4 font-medium text-center">Status</th>
                <th class="px-6 py-4 font-medium text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white/50">
            @forelse($peminjaman as $item)
            <tr class="hover:bg-white transition-colors">
                <td class="px-6 py-4">
                    <p class="font-bold text-nusantara-dark">{{ $item->buku->judul ?? 'Buku Tidak Diketahui' }}</p>
                    <p class="text-xs text-gray-500">{{ $item->buku->pengarang ?? '-' }}</p>
                </td>
                <td class="px-6 py-4 text-sm text-gray-600">
                    <p><strong>Dipinjam:</strong> {{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d M Y') }}</p>
                    <p><strong>Tenggat:</strong> {{ \Carbon\Carbon::parse($item->tgl_tenggat)->format('d M Y') }}</p>
                </td>
                <td class="px-6 py-4 text-center">
                    @if($item->status == 'Dipinjam')
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-bold">Sedang Dipinjam</span>
                    @else
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">Selesai</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-right">
                    @if($item->status == 'Dipinjam')
                    <form action="{{ route('siswa.peminjaman.kembalikan', $item->id_peminjaman) }}" method="POST" onsubmit="return confirm('Kamu yakin ingin mengembalikan buku ini sekarang?');">
                        @csrf
                        <button type="submit" class="bg-nusantara-brown hover:bg-nusantara-dark text-white px-4 py-2 rounded-lg text-sm font-bold transition-colors shadow-sm">
                            Kembalikan Buku
                        </button>
                    </form>
                    @else
                    <span class="text-gray-400 text-sm italic">Dikembalikan pada {{ \Carbon\Carbon::parse($item->tgl_dikembalikan)->format('d M') }}</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                    <i class="fa-solid fa-face-frown text-4xl mb-4 text-gray-300 block"></i>
                    Kamu belum pernah meminjam buku.
                    <br>
                    <a href="{{ route('siswa.buku.index') }}" class="inline-block mt-4 text-nusantara-gold hover:text-nusantara-brown font-bold">Pinjam Buku Pertamamu &rarr;</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
