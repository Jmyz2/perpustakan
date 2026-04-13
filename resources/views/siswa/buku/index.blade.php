@extends('layouts.dashboard')
@section('page_title', 'Katalog Buku')

@section('dashboard_content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-xl font-serif font-bold text-nusantara-dark">Buku Tersedia</h2>
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

<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @forelse($buku as $item)
    <div class="glass-panel rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 flex flex-col">
        <div class="h-48 bg-nusantara-brown/10 flex items-center justify-center relative">
            <!-- Menampilkan icon buku ilustrasi jika cover tidak ada -->
            <i class="fa-solid fa-book-journal-whills text-6xl text-nusantara-brown/40"></i>
            <div class="absolute top-3 right-3 bg-white/90 px-2 py-1 rounded text-xs font-bold text-nusantara-dark shadow-sm">
                Stok: {{ $item->stok_buku }}
            </div>
        </div>
        <div class="p-5 flex-1 flex flex-col">
            <h3 class="font-bold text-lg text-nusantara-dark leading-tight mb-1">{{ $item->judul }}</h3>
            <p class="text-sm text-gray-500 mb-3">{{ $item->pengarang }}</p>
            <div class="mt-auto">
                <form action="{{ route('siswa.peminjaman.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_buku" value="{{ $item->id_buku }}">
                    <button type="submit" class="w-full bg-nusantara-brown hover:bg-nusantara-dark text-white font-medium py-2 rounded-lg transition-colors shadow-sm text-sm" onclick="return confirm('Apakah Anda yakin ingin meminjam buku ini?')">
                        Pinjam Buku
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full glass-panel p-12 text-center rounded-2xl">
        <i class="fa-solid fa-book-open text-4xl mb-4 text-gray-300"></i>
        <h3 class="text-xl font-medium text-gray-500">Maaf, belum ada buku yang tersedia saat ini.</h3>
    </div>
    @endforelse
</div>
@endsection
