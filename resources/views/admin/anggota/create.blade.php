@extends('layouts.dashboard')
@section('page_title', 'Tambah Anggota Baru')

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

    <form action="{{ route('anggota.store') }}" method="POST">
        @csrf
        
        <h3 class="text-lg font-serif font-bold text-nusantara-dark border-b pb-2 mb-4">Data Profil Siswa</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">NIS</label>
                <input class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold" type="text" name="nis" value="{{ old('nis') }}" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Nama Lengkap</label>
                <input class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold" type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Kelas</label>
                <input class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold" type="text" name="kelas" value="{{ old('kelas') }}" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">No. Telepon (Opsional)</label>
                <input class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold" type="text" name="no_telp" value="{{ old('no_telp') }}">
            </div>
        </div>

        <h3 class="text-lg font-serif font-bold text-nusantara-dark border-b pb-2 mb-4 mt-8">Data Akun Login</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Email</label>
                <input class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold" type="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                <input class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold" type="password" name="password" required minlength="8">
            </div>
        </div>
        
        <div class="flex justify-end">
            <button class="bg-nusantara-brown hover:bg-nusantara-dark text-white font-bold py-2 px-6 rounded-lg transition-colors shadow-sm" type="submit">
                Simpan & Daftarkan
            </button>
        </div>
    </form>
</div>
@endsection
