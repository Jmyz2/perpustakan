@extends('layouts.dashboard')
@section('page_title', 'Kelola Data Buku')

@section('dashboard_content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-xl font-serif font-bold text-nusantara-dark">Daftar Buku</h2>
    <a href="{{ route('buku.create') }}" class="bg-nusantara-brown hover:bg-nusantara-dark text-white px-4 py-2 rounded-lg font-medium transition-colors shadow-sm inline-flex items-center">
        <i class="fa-solid fa-plus mr-2"></i> Tambah Buku Baru
    </a>
</div>

@if(session('success'))
<div class="bg-green-50 text-green-700 p-4 rounded-lg mb-6 border border-green-200">
    <i class="fa-solid fa-check-circle mr-2"></i> {{ session('success') }}
</div>
@endif

<div class="glass-panel overflow-hidden rounded-2xl shadow-sm">
    <table class="w-full text-left">
        <thead class="bg-nusantara-brown text-white">
            <tr>
                <th class="px-6 py-4 font-medium">Kode Buku</th>
                <th class="px-6 py-4 font-medium">Judul Buku</th>
                <th class="px-6 py-4 font-medium">Pengarang</th>
                <th class="px-6 py-4 font-medium text-center">Stok</th>
                <th class="px-6 py-4 font-medium text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white/50">
            @forelse($buku as $item)
            <tr class="hover:bg-white transition-colors">
                <td class="px-6 py-4 font-medium text-gray-800">{{ $item->kode_buku }}</td>
                <td class="px-6 py-4">
                    <p class="font-bold text-nusantara-dark">{{ $item->judul }}</p>
                    <p class="text-xs text-gray-500">{{ $item->penerbit }} ({{ $item->tahun_terbit }})</p>
                </td>
                <td class="px-6 py-4 text-gray-600">{{ $item->pengarang }}</td>
                <td class="px-6 py-4 text-center">
                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ $item->stok_buku > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $item->stok_buku }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('buku.edit', $item->id_buku) }}" class="text-nusantara-gold hover:text-nusantara-brown transition-colors p-2" title="Edit">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <form action="{{ route('buku.destroy', $item->id_buku) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 transition-colors p-2" title="Hapus">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                    <i class="fa-solid fa-inbox text-4xl mb-3 text-gray-300 block"></i>
                    Belum ada data buku.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
