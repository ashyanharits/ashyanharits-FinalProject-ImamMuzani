@extends('layouts.dashboard')

@section('judul', 'Admin Dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-amber-50 to-white flex flex-col">

    {{-- Navbar --}}
    <nav class="flex justify-between items-center px-8 py-4 bg-white shadow-sm border-b border-amber-100">
        <div class="flex items-center space-x-2">
            <img src="{{ asset('images/logoremove.png') }}" alt="Logo Madrasah Imam Muzani" class="w-12 h-12">
            <h1 class="text-xl font-semibold" style="color:#5C3A00;">Madrasah Imam Muzani</h1>
        </div>

        <div class="space-x-6">
            <a href="{{ route('admin.dashboard') }}" class="text-[#C57A00] font-semibold">Dashboard</a>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="text-red-500 hover:underline">
               Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </nav>

    {{-- Hero / Welcome --}}
    <section class="flex flex-col items-center justify-center flex-1 text-center px-6 py-20">
        <h2 class="text-4xl sm:text-5xl font-extrabold mb-6" style="color:#5C3A00;">
            Selamat Datang, Admin Imam Muzani 👋
        </h2>
        <p class="max-w-2xl text-gray-700 text-lg mb-8">
            Kamu berhasil login sebagai <strong>Admin</strong>.
        </p>
    </section>

    {{-- Dashboard Cards --}}
    <section class="px-6 py-12 max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-3 gap-8">
        @livewire('card-dashboard')
    </section>

    {{-- Footer --}}
    <footer class="text-center py-4 bg-amber-100" style="color:#5C3A00;">
        &copy; {{ date('Y') }} Madrasah Imam Muzani. All rights reserved.
    </footer>

</div>
@endsection
