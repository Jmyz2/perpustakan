@extends('layouts.app')
@section('title', 'Daftar Anggota')

@section('content')
<div class="flex-grow flex items-center justify-center p-6">
    <div class="glass-panel rounded-2xl shadow-2xl overflow-hidden max-w-2xl w-full bg-white p-8 lg:p-12">
        <div class="text-center mb-8">
            <i class="fa-solid fa-user-plus text-4xl mb-4 text-nusantara-gold"></i>
            <h2 class="font-serif text-3xl font-bold text-nusantara-brown mb-2">Pendaftaran Anggota</h2>
            <p class="text-gray-500">Isi data di bawah ini untuk menjadi anggota perpustakaan.</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 text-red-500 p-4 rounded-lg mb-6 border border-red-200">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('register') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- NIS -->
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="nis">
                        Nomor Induk Siswa (NIS)
                    </label>
                    <input class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold focus:ring-1 focus:ring-nusantara-gold" id="nis" type="text" name="nis" value="{{ old('nis') }}" required>
                </div>
                
                <!-- Nama Lengkap -->
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="name">
                        Nama Lengkap
                    </label>
                    <input class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold focus:ring-1 focus:ring-nusantara-gold" id="name" type="text" name="name" value="{{ old('name') }}" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Kelas -->
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="kelas">
                        Kelas
                    </label>
                    <input class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold focus:ring-1 focus:ring-nusantara-gold" id="kelas" type="text" name="kelas" value="{{ old('kelas') }}" required placeholder="Contoh: XII RPL 1">
                </div>
                
                <!-- No Telepon -->
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="no_telp">
                        Nomor Handphone
                    </label>
                    <input class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold focus:ring-1 focus:ring-nusantara-gold" id="no_telp" type="text" name="no_telp" value="{{ old('no_telp') }}">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-semibold mb-2" for="email">
                    Alamat Email (Digunakan untuk Login)
                </label>
                <input class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold focus:ring-1 focus:ring-nusantara-gold" id="email" type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Password -->
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="password">
                        Kata Sandi
                    </label>
                    <input class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold focus:ring-1 focus:ring-nusantara-gold" id="password" type="password" name="password" required minlength="8">
                </div>
                
                <!-- Konfirmasi Password -->
                <div>
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="password_confirmation">
                        Konfirmasi Kata Sandi
                    </label>
                    <input class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold focus:ring-1 focus:ring-nusantara-gold" id="password_confirmation" type="password" name="password_confirmation" required minlength="8">
                </div>
            </div>

            <button class="w-full bg-nusantara-brown hover:bg-nusantara-dark text-white font-bold py-3 px-4 rounded-lg transition-colors shadow-lg" type="submit">
                Daftar Sekarang
            </button>
        </form>

        <p class="mt-8 text-center text-sm text-gray-600">
            Sudah punya akun? 
            <a href="{{ url('login') }}" class="font-bold text-nusantara-gold hover:text-nusantara-brown transition-colors">Masuk di sini</a>
        </p>
    </div>
</div>
@endsection
