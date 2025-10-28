@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-4xl font-extrabold text-indigo-600 mb-4">Selamat Datang, Admin Imam Muzani 👋</h1>
        <p class="text-gray-600 text-lg">Kamu berhasil login sebagai <strong>Admin</strong>.</p>

        <div class="mt-6">
            <a href="{{ route('logout') }}" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="text-red-500 hover:underline">
               Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </div>
</div>
@endsection
