@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col bg-gradient-to-b from-amber-50 to-white font-sans">

    {{-- Navbar --}}
    <nav class="fixed w-full bg-white shadow-md z-50 border-b border-amber-100">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logoremove.png') }}" alt="Logo" class="w-10 h-10">
                <h1 class="text-xl font-semibold text-[#5C3A00]">Madrasah Imam Muzani</h1>
            </div>
            <div class="hidden md:flex space-x-6 text-sm font-medium">
                <a href="#beranda" class="hover:text-[#C57A00] transition">Beranda</a>
                <a href="#tentang" class="hover:text-[#C57A00] transition">Tentang</a>
                <a href="#program" class="hover:text-[#C57A00] transition">Program</a>
                <a href="#kontak" class="hover:text-[#C57A00] transition">Kontak</a>
                @auth
                    @php
                        $dashboardUrl = Auth::user()->role === 'admin' 
                            ? route('admin.dashboard') 
                            : route('dashboardustadz');
                    @endphp
                    <a href="{{ $dashboardUrl }}" class="text-[#C57A00] font-semibold">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-[#C57A00] transition">Login</a>
                    <a href="{{ route('register') }}" class="hover:text-[#C57A00] transition">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section id="beranda" class="flex flex-col justify-center items-center text-center pt-40 pb-24 px-6 bg-gradient-to-b from-white to-amber-50">
        <img src="{{ asset('images/logoremove.png') }}" alt="Logo Madrasah" class="w-28 h-28 mb-6 animate-fade-in">
        <h2 class="text-4xl sm:text-5xl font-extrabold mb-4 text-[#5C3A00] leading-snug">
            Madrasah Imam Muzani
        </h2>
        <p class="text-gray-600 max-w-2xl mb-8 text-lg">
            Mewujudkan generasi Qurani yang berilmu, berakhlak mulia, dan siap menghadapi tantangan zaman modern.
        </p>
        <a href="{{ route('register') }}"
           class="px-8 py-3 rounded-full text-white font-semibold shadow-md transition hover:scale-105"
           style="background-color:#C57A00;">
           Daftar Sekarang
        </a>
    </section>

    {{-- Tentang Kami --}}
    <section id="tentang" class="py-20 px-6 text-center bg-white">
        <div class="max-w-4xl mx-auto">
            <h3 class="text-3xl font-bold text-[#5C3A00] mb-6">Tentang Kami</h3>
            <p class="text-gray-700 leading-relaxed">
                Madrasah Imam Muzani adalah lembaga pendidikan Islam yang mengutamakan pembelajaran berbasis Al-Qur'an dan Sunnah.
                Kami berkomitmen mencetak generasi yang berilmu, beriman, dan berakhlak mulia melalui pembelajaran modern dan metode islami.
            </p>
        </div>
    </section>

    {{-- Program --}}
    <section id="program" class="py-20 px-6 bg-gradient-to-b from-amber-50 to-white text-center">
        <h3 class="text-3xl font-bold text-[#5C3A00] mb-12">Program Unggulan</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg p-8 border-t-4" style="border-color:#C57A00;">
                <h4 class="text-xl font-semibold text-[#C57A00] mb-3">Tahfidzul Qur'an</h4>
                <p class="text-gray-600">Program hafalan Al-Qur'an dengan bimbingan para ustadz berpengalaman untuk mencetak para hafidz yang berakhlak.</p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-8 border-t-4" style="border-color:#C57A00;">
                <h4 class="text-xl font-semibold text-[#C57A00] mb-3">Bahasa Arab & Inggris</h4>
                <p class="text-gray-600">Pembelajaran dua bahasa utama dunia Islam dan global guna mendukung pemahaman dan komunikasi internasional.</p>
            </div>
            <div class="bg-white rounded-2xl shadow-lg p-8 border-t-4" style="border-color:#C57A00;">
                <h4 class="text-xl font-semibold text-[#C57A00] mb-3">Akhlak & Kepemimpinan</h4>
                <p class="text-gray-600">Menanamkan nilai-nilai moral, karakter, dan kepemimpinan Islami untuk mencetak calon pemimpin masa depan.</p>
            </div>
        </div>
    </section>

    {{-- Kontak --}}
    <section id="kontak" class="py-20 px-6 bg-white text-center">
        <div class="max-w-4xl mx-auto">
            <h3 class="text-3xl font-bold text-[#5C3A00] mb-8">Hubungi Kami</h3>
            <p class="text-gray-600 mb-6">Untuk informasi lebih lanjut, silakan hubungi kami melalui kontak berikut:</p>
            <div class="space-y-2 text-gray-700">
                <p>Email: <span class="font-medium text-[#C57A00]">info@imammuzani.sch.id</span></p>
                <p>Telepon: <span class="font-medium text-[#C57A00]">(+62) 812-3456-7890</span></p>
                <p>Alamat: <span class="font-medium text-[#C57A00]">Jl. Imam Muzani No. 12, Bandung</span></p>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="text-center py-6 bg-[#5C3A00] text-white text-sm">
        <p>&copy; {{ date('Y') }} Madrasah Imam Muzani. Semua Hak Cipta Dilindungi.</p>
    </footer>
</div>

{{-- Simple fade animation --}}
<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
.animate-fade-in {
    animation: fade-in 1.2s ease-in-out;
}
</style>
@endsection
