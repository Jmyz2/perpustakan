@extends('layouts.app')
@section('title', 'Login')

@section('content')
<div class="flex-grow flex items-center justify-center p-6">
    <div class="glass-panel rounded-2xl shadow-2xl overflow-hidden flex max-w-4xl w-full">
        <!-- Image Section (Left) -->
        <div class="hidden md:block md:w-1/2 bg-nusantara-brown relative">
            <div class="absolute inset-0 bg-black opacity-30"></div>
            <!-- Dummy Batik / Book background image from unsplash -->
            <img src="https://images.unsplash.com/photo-1549675584-91f19337af3d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Library" class="w-full h-full object-cover mix-blend-overlay">
            <div class="absolute inset-0 flex flex-col justify-center items-center text-white p-8 text-center z-10">
                <i class="fa-solid fa-book-open text-6xl mb-4 text-nusantara-gold"></i>
                <h2 class="font-serif text-3xl font-bold mb-2">Pustaka Nusantara</h2>
                <p class="font-sans font-light">"Membaca adalah wujud cinta pada bangsa."</p>
            </div>
        </div>

        <!-- Form Section (Right) -->
        <div class="w-full md:w-1/2 p-8 lg:p-12 bg-white">
            <h2 class="font-serif text-3xl font-bold text-nusantara-brown mb-2">Selamat Datang</h2>
            <p class="text-gray-500 mb-8">Silakan masuk ke akun Anda.</p>

            @if ($errors->any())
                <div class="bg-red-50 text-red-500 p-4 rounded-lg mb-6 border border-red-200">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('login') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="email">
                        Alamat Email
                    </label>
                    <div class="relative">
                        <i class="fa-regular fa-envelope absolute left-4 top-3.5 text-gray-400"></i>
                        <input class="w-full pl-11 pr-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold focus:ring-1 focus:ring-nusantara-gold transition-colors" id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="Masukkan email">
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="password">
                        Kata Sandi
                    </label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-4 top-3.5 text-gray-400"></i>
                        <input class="w-full pl-11 pr-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:border-nusantara-gold focus:ring-1 focus:ring-nusantara-gold transition-colors" id="password" type="password" name="password" required placeholder="Masukkan password">
                    </div>
                </div>

                <div class="flex items-center justify-between mb-8">
                    <label class="flex items-center text-sm text-gray-600">
                        <input type="checkbox" name="remember" class="mr-2 rounded text-nusantara-brown focus:ring-nusantara-gold"> Ingat Saya
                    </label>
                </div>

                <button class="w-full bg-nusantara-brown hover:bg-nusantara-dark text-white font-bold py-3 px-4 rounded-lg transition-colors shadow-lg" type="submit">
                    Masuk
                </button>
            </form>

            <p class="mt-8 text-center text-sm text-gray-600">
                Belum punya akun anggota? 
                <a href="{{ url('register') }}" class="font-bold text-nusantara-gold hover:text-nusantara-brown transition-colors">Daftar sekarang</a>
            </p>
        </div>
    </div>
</div>
@endsection
