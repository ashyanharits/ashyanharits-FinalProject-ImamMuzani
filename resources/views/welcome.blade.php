@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-amber-50 to-white flex flex-col">
        {{-- Navbar --}}
        <nav class="flex justify-between items-center px-8 py-4 bg-white shadow-sm border-b border-amber-100">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/logoremove.png') }}" alt="Logo Madrasah Imam Muzani" class="w-12 h-12">
                <h1 class="text-xl font-semibold" style="color:#5C3A00;">Madrasah Imam Muzani</h1>
            </div>

            <div class="space-x-6">
                <a href="#beranda" class="text-gray-700 hover:text-[#C57A00] font-medium">Beranda</a>
                <a href="#tentang" class="text-gray-700 hover:text-[#C57A00] font-medium">Tentang</a>
                <a href="#program" class="text-gray-700 hover:text-[#C57A00] font-medium">Program</a>
                <a href="#kontak" class="text-gray-700 hover:text-[#C57A00] font-medium">Kontak</a>
                @auth
                    <a href="{{ url('/home') }}" class="text-[#C57A00] font-semibold">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-[#C57A00] font-semibold">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-[#C57A00] font-semibold">Register</a>
                @endauth
            </div>
        </nav>

        {{-- Hero Section --}}
        <section id="beranda" class="flex flex-col items-center justify-center flex-1 text-center px-6 py-20">
            <img src="{{ asset('images/logoremove.png') }}" alt="Logo Madrasah Imam Muzani" class="w-32 h-32 mb-6">
            <h2 class="text-4xl sm:text-5xl font-extrabold mb-6" style="color:#5C3A00;">
                Selamat Datang di Madrasah Imam Muzani
            </h2>
            <p class="max-w-2xl text-gray-600 text-lg mb-8">
                Mencetak generasi Qurani yang berilmu, berakhlak mulia, dan siap menghadapi tantangan zaman.
            </p>
            <a href="{{ route('register') }}"
               class="px-6 py-3 rounded-lg font-semibold text-white shadow-md transition duration-200"
               style="background-color:#C57A00; hover:background-color:#A86400;">
                Daftar Sekarang
            </a>
        </section>

        {{-- Tentang --}}
        <section id="tentang" class="bg-white py-20 px-6 text-center">
            <h3 class="text-3xl font-bold mb-6" style="color:#5C3A00;">Tentang Kami</h3>
            <p class="max-w-3xl mx-auto text-gray-700 leading-relaxed">
                Madrasah Imam Muzani adalah lembaga pendidikan Islam yang berkomitmen untuk memberikan pendidikan
                berbasis nilai-nilai Al-Qur'an dan Sunnah. Kami membina peserta didik agar menjadi insan beriman,
                berilmu, dan beramal shalih.
            </p>
        </section>

        {{-- Program --}}
        <section id="program" class="py-20 px-6 text-center" style="background-color:#FFF7EB;">
            <h3 class="text-3xl font-bold mb-12" style="color:#5C3A00;">Program Unggulan</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <div class="bg-white shadow-md rounded-xl p-6 hover:shadow-lg transition border-t-4" style="border-color:#C57A00;">
                    <h4 class="text-xl font-semibold mb-3" style="color:#C57A00;">Tahfidzul Qur'an</h4>
                    <p class="text-gray-600">Program hafalan Al-Qur'an yang dibimbing oleh ustadz-ustadz berpengalaman.</p>
                </div>
                <div class="bg-white shadow-md rounded-xl p-6 hover:shadow-lg transition border-t-4" style="border-color:#C57A00;">
                    <h4 class="text-xl font-semibold mb-3" style="color:#C57A00;">Bahasa Arab & Inggris</h4>
                    <p class="text-gray-600">Pembelajaran dua bahasa utama untuk menunjang pemahaman ilmu dan komunikasi global.</p>
                </div>
                <div class="bg-white shadow-md rounded-xl p-6 hover:shadow-lg transition border-t-4" style="border-color:#C57A00;">
                    <h4 class="text-xl font-semibold mb-3" style="color:#C57A00;">Akhlak & Kepemimpinan</h4>
                    <p class="text-gray-600">Menanamkan nilai-nilai akhlak dan karakter kepemimpinan Islami sejak dini.</p>
                </div>
            </div>
        </section>

        {{-- Kontak --}}
        <section id="kontak" class="bg-white py-20 px-6 text-center">
            <h3 class="text-3xl font-bold mb-6" style="color:#5C3A00;">Hubungi Kami</h3>
            <p class="text-gray-600 mb-8">Untuk informasi lebih lanjut, silakan hubungi kami melalui kontak berikut:</p>
            <div class="space-y-2 text-gray-700">
                <p>Email: <span class="font-medium" style="color:#C57A00;">info@imammuzani.sch.id</span></p>
                <p>Telepon: <span class="font-medium" style="color:#C57A00;">(+62) 812-3456-7890</span></p>
                <p>Alamat: <span class="font-medium" style="color:#C57A00;">Jl. Imam Muzani No. 12, Bandung</span></p>
            </div>
        </section>

        {{-- Footer --}}
        <footer class="text-center py-4" style="background-color:#5C3A00; color:white;">
            <p>&copy; {{ date('Y') }} Madrasah Imam Muzani. All rights reserved.</p>
        </footer>
    </div>
@endsection
