@extends('layouts.dashboard')
@section('page_title', 'Edit Data Anggota')

@section('dashboard_content')
<div class="mb-6">
    <a href="{{ route('anggota.index') }}" class="text-nusantara-brown hover:text-nusantara-dark transition-colors">
        <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Daftar Anggota
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

    <form action="{{ route('anggota.update', $anggota->id_anggota) }}" method="POST">
        @csrf
        @method('PUT')
        
        <h3 class="text-lg font-serif font-bold text-nusantara-dark border-b pb-2 mb-4">Data Profil Siswa</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">NIS</label>
                <input class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold" type="text" name="nis" value="{{ old('nis', $anggota->nis) }}" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Nama Lengkap</label>
                <input class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold" type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $anggota->nama_lengkap) }}" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Kelas</label>
                <input class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold" type="text" name="kelas" value="{{ old('kelas', $anggota->kelas) }}" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">No. Telepon (Opsional)</label>
                <input class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold" type="text" name="no_telp" value="{{ old('no_telp', $anggota->no_telp) }}">
            </div>
        </div>

        <h3 class="text-lg font-serif font-bold text-nusantara-dark border-b pb-2 mb-4 mt-8">Data Akun Login</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                <input class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold" type="email" name="email" value="{{ old('email', $anggota->user->email ?? '') }}" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Password (Isi jika ingin diubah)</label>
                <input class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold" type="password" name="password" minlength="8" placeholder="Kosongkan jika tidak ingin mengubah password">
            </div>
        </div>
        
        <div class="flex justify-end">
            <button class="bg-nusantara-gold hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-lg transition-colors shadow-sm" type="submit">
                Perbarui Data
            </button>
        </div>
    </form>
</div>
@endsection
