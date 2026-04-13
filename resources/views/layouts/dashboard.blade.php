@extends('layouts.app')

@section('content')
<div class="flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <aside class="w-64 bg-nusantara-brown shadow-xl flex-shrink-0 flex flex-col z-20 transition-all duration-300 relative">
        <!-- Sidebar Batik Texture Overlay -->
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/black-linen.png')] mix-blend-overlay pointer-events-none"></div>
        
        <!-- Logo Area -->
        <div class="h-16 flex items-center px-6 border-b border-white/20 relative z-10">
            <i class="fa-solid fa-book-open text-nusantara-gold text-2xl mr-3"></i>
            <span class="text-white font-serif font-bold text-xl tracking-wider">Pustaka</span>
        </div>

        <!-- Menu Links -->
        <nav class="flex-1 overflow-y-auto py-4 relative z-10">
            @if(Auth::user()->role == 'admin')
            <ul class="space-y-1 px-3">
                <li>
                    <a href="{{ url('admin/dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'bg-nusantara-dark text-nusantara-gold border-l-4 border-nusantara-gold' : 'text-gray-300 hover:bg-white/10 hover:text-white border-l-4 border-transparent' }} flex items-center px-4 py-3 rounded-r-lg transition-colors group">
                        <i class="fa-solid fa-gauge w-5 text-center mr-3 group-hover:scale-110 transition-transform"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/buku') }}" class="{{ request()->is('admin/buku*') ? 'bg-nusantara-dark text-nusantara-gold border-l-4 border-nusantara-gold' : 'text-gray-300 hover:bg-white/10 hover:text-white border-l-4 border-transparent' }} flex items-center px-4 py-3 rounded-r-lg transition-colors group">
                        <i class="fa-solid fa-book w-5 text-center mr-3 group-hover:scale-110 transition-transform"></i>
                        <span class="font-medium">Kelola Buku</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/anggota') }}" class="{{ request()->is('admin/anggota*') ? 'bg-nusantara-dark text-nusantara-gold border-l-4 border-nusantara-gold' : 'text-gray-300 hover:bg-white/10 hover:text-white border-l-4 border-transparent' }} flex items-center px-4 py-3 rounded-r-lg transition-colors group">
                        <i class="fa-solid fa-users w-5 text-center mr-3 group-hover:scale-110 transition-transform"></i>
                        <span class="font-medium">Kelola Anggota</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/peminjaman') }}" class="{{ request()->is('admin/peminjaman*') ? 'bg-nusantara-dark text-nusantara-gold border-l-4 border-nusantara-gold' : 'text-gray-300 hover:bg-white/10 hover:text-white border-l-4 border-transparent' }} flex items-center px-4 py-3 rounded-r-lg transition-colors group">
                        <i class="fa-solid fa-handshake w-5 text-center mr-3 group-hover:scale-110 transition-transform"></i>
                        <span class="font-medium">Transaksi Pinjam</span>
                    </a>
                </li>
            </ul>
            @else
            <ul class="space-y-1 px-3">
                <li>
                    <a href="{{ url('siswa/dashboard') }}" class="{{ request()->is('siswa/dashboard') ? 'bg-nusantara-dark text-nusantara-gold border-l-4 border-nusantara-gold' : 'text-gray-300 hover:bg-white/10 hover:text-white border-l-4 border-transparent' }} flex items-center px-4 py-3 rounded-r-lg transition-colors group">
                        <i class="fa-solid fa-house w-5 text-center mr-3 group-hover:scale-110 transition-transform"></i>
                        <span class="font-medium">Halaman Utama</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('siswa/buku') }}" class="{{ request()->is('siswa/buku*') ? 'bg-nusantara-dark text-nusantara-gold border-l-4 border-nusantara-gold' : 'text-gray-300 hover:bg-white/10 hover:text-white border-l-4 border-transparent' }} flex items-center px-4 py-3 rounded-r-lg transition-colors group">
                        <i class="fa-solid fa-book-open w-5 text-center mr-3 group-hover:scale-110 transition-transform"></i>
                        <span class="font-medium">Katalog Buku</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('siswa/peminjaman') }}" class="{{ request()->is('siswa/peminjaman*') ? 'bg-nusantara-dark text-nusantara-gold border-l-4 border-nusantara-gold' : 'text-gray-300 hover:bg-white/10 hover:text-white border-l-4 border-transparent' }} flex items-center px-4 py-3 rounded-r-lg transition-colors group">
                        <i class="fa-solid fa-clock-rotate-left w-5 text-center mr-3 group-hover:scale-110 transition-transform"></i>
                        <span class="font-medium">Riwayat Peminjaman</span>
                    </a>
                </li>
            </ul>
            @endif
        </nav>

        <!-- User profile bottom -->
        <div class="h-16 flex items-center px-6 border-t border-white/20 relative z-10 bg-nusantara-dark/50">
            <div class="flex-1 min-w-0 pr-4">
                <p class="text-white text-sm font-semibold truncate">{{ Auth::user()->name }}</p>
                <p class="text-nusantara-gold text-xs uppercase tracking-wider">{{ Auth::user()->role }}</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-gray-300 hover:text-white p-2 rounded hover:bg-white/10 transition-colors" title="Logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content wrapper -->
    <div class="flex-1 flex flex-col overflow-hidden relative">
        <div class="absolute inset-x-0 top-0 h-32 bg-gradient-to-b from-nusantara-gold/5 pointer-events-none"></div>

        <!-- Top Header -->
        <header class="h-16 glass-panel border-b border-gray-200 flex items-center justify-between px-8 z-10">
            <h1 class="text-xl font-bold font-serif text-nusantara-brown">@yield('page_title', 'Dashboard')</h1>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-500 font-medium">{{ date('d F Y') }}</span>
                <div class="w-8 h-8 rounded-full bg-nusantara-gold flex items-center justify-center text-white shadow-md">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-transparent p-6 z-10">
            <div class="max-w-7xl mx-auto drop-shadow-sm">
                @yield('dashboard_content')
            </div>
        </main>
    </div>
</div>
@endsection
