@extends('layouts.dashboard')
@section('page_title', 'Kelola Data Anggota')

@section('dashboard_content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-xl font-serif font-bold text-nusantara-dark">Daftar Anggota</h2>
    <a href="{{ route('anggota.create') }}" class="bg-nusantara-brown hover:bg-nusantara-dark text-white px-4 py-2 rounded-lg font-medium transition-colors shadow-sm inline-flex items-center">
        <i class="fa-solid fa-user-plus mr-2"></i> Tambah Anggota
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
                <th class="px-6 py-4 font-medium">NIS</th>
                <th class="px-6 py-4 font-medium">Nama / Email</th>
                <th class="px-6 py-4 font-medium">Kelas</th>
                <th class="px-6 py-4 font-medium">No. Telepon</th>
                <th class="px-6 py-4 font-medium text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white/50">
            @forelse($anggota as $item)
            <tr class="hover:bg-white transition-colors">
                <td class="px-6 py-4 font-medium text-gray-800">{{ $item->nis }}</td>
                <td class="px-6 py-4">
                    <p class="font-bold text-nusantara-dark">{{ $item->nama_lengkap }}</p>
                    <p class="text-xs text-gray-500">{{ $item->user->email ?? '-' }}</p>
                </td>
                <td class="px-6 py-4 text-gray-600">{{ $item->kelas }}</td>
                <td class="px-6 py-4 text-gray-600">{{ $item->no_telp ?? '-' }}</td>
                <td class="px-6 py-4 text-right space-x-2">
                    <a href="{{ route('anggota.edit', $item->id_anggota) }}" class="text-nusantara-gold hover:text-nusantara-brown transition-colors p-2" title="Edit">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <form action="{{ route('anggota.destroy', $item->id_anggota) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus anggota ini? Akun login mereka juga akan terhapus.');">
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
                    <i class="fa-solid fa-users-slash text-4xl mb-3 text-gray-300 block"></i>
                    Belum ada data anggota.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
