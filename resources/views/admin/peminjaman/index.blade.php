@extends('layouts.dashboard')
@section('page_title', 'Data Transaksi Peminjaman')

@section('dashboard_content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-xl font-serif font-bold text-nusantara-dark">Daftar Transaksi</h2>
    <a href="{{ route('peminjaman.create') }}" class="bg-nusantara-brown hover:bg-nusantara-dark text-white px-4 py-2 rounded-lg font-medium transition-colors shadow-sm inline-flex items-center">
        <i class="fa-solid fa-plus mr-2"></i> Tambah Transaksi Pinjam
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
                <th class="px-6 py-4 font-medium">Peminjam</th>
                <th class="px-6 py-4 font-medium">Tanggal</th>
                <th class="px-6 py-4 font-medium text-center">Status</th>
                <th class="px-6 py-4 font-medium text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white/50">
            @forelse($peminjaman as $item)
            <tr class="hover:bg-white transition-colors">
                <td class="px-6 py-4">
                    <p class="font-bold text-nusantara-dark">{{ $item->buku->judul ?? 'Buku Dihapus' }}</p>
                    <p class="text-xs text-gray-500">Kode: {{ $item->buku->kode_buku ?? '-' }}</p>
                </td>
                <td class="px-6 py-4">
                    <p class="font-medium text-gray-800">{{ $item->anggota->nama_lengkap ?? 'Anggota Dihapus' }}</p>
                    <p class="text-xs text-gray-500">NIS: {{ $item->anggota->nis ?? '-' }}</p>
                </td>
                <td class="px-6 py-4 text-sm text-gray-600">
                    <p><strong>P:</strong> {{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d M Y') }}</p>
                    <p><strong>T:</strong> {{ \Carbon\Carbon::parse($item->tgl_tenggat)->format('d M Y') }}</p>
                    @if($item->tgl_dikembalikan)
                    <p class="text-green-600"><strong>K:</strong> {{ \Carbon\Carbon::parse($item->tgl_dikembalikan)->format('d M Y') }}</p>
                    @endif
                </td>
                <td class="px-6 py-4 text-center">
                    @if($item->status == 'Dipinjam')
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-bold">Dipinjam</span>
                    @else
                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">Selesai</span>
                    @endif
                </td>
                <td class="px-6 py-4 text-right space-x-2">
                    @if($item->status == 'Dipinjam')
                    <form action="{{ route('admin.peminjaman.kembalikan', $item->id_peminjaman) }}" method="POST" class="inline-block" onsubmit="return confirm('Konfirmasi buku telah dikembalikan?');">
                        @csrf
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs font-bold transition-colors">
                            <i class="fa-solid fa-rotate-left mr-1"></i> Kembalikan
                        </button>
                    </form>
                    @endif
                    <form action="{{ route('peminjaman.destroy', $item->id_peminjaman) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus data transaksi ini permanen?');">
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
                    <i class="fa-solid fa-handshake-slash text-4xl mb-3 text-gray-300 block"></i>
                    Belum ada data transaksi.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
