{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.dashboard')

@section('page-title', 'Dashboard')

@section('content')
{{-- ================= Header / Greeting ================= --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-0">Selamat Datang, {{ Auth::user()->name ?? 'Admin' }} 👋</h3>
        <small class="text-muted">Hari ini: {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</small>
    </div>

    <div class="d-flex align-items-center gap-2">
        {{-- Dark mode toggle --}}
        <button id="themeToggle" class="btn btn-sm btn-outline-secondary" title="Toggle theme">
            <i id="themeIcon" class="bi bi-moon-fill"></i>
        </button>

        {{-- Notification bell (placeholder) --}}
        <button id="notifyTest" class="btn btn-sm btn-outline-primary" title="Test notification">
            <i class="bi bi-bell-fill"></i>
        </button>

        {{-- Quick export buttons (ganti route sesuai) --}}
        <a href="{{ route('admin.export.excel') ?? '#' }}" class="btn btn-sm btn-success">
            <i class="bi bi-file-earmark-excel"></i> Export Excel
        </a>
        <a href="{{ route('admin.export.pdf') ?? '#' }}" class="btn btn-sm btn-danger">
            <i class="bi bi-file-earmark-pdf"></i> Export PDF
        </a>
    </div>
</div>

{{-- ================= Summary Cards ================= --}}
@php
    // pastikan controller mengirimkan $totalSantri, $totalUstadz, $totalKelas, $totalPelajaran
    $totals = [
        ['title'=>'Total Santri','icon'=>'bi-people','color'=>'primary','value'=> $totalSantri ?? 0],
        ['title'=>'Total Ustadz','icon'=>'bi-person-badge','color'=>'success','value'=> $totalUstadz ?? 0],
        ['title'=>'Total Kelas','icon'=>'bi-building','color'=>'warning','value'=> $totalKelas ?? 0],
        ['title'=>'Total Pelajaran','icon'=>'bi-book','color'=>'danger','value'=> $totalPelajaran ?? 0],
    ];
@endphp

<div class="row g-3 mb-4">
    @foreach($totals as $card)
        <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm border-0 rounded-3 hover-card p-3 h-100">
                <div class="d-flex align-items-center">
                    <div class="me-3 text-{{ $card['color'] }} fs-2">
                        <i class="bi {{ $card['icon'] }}"></i>
                    </div>
                    <div class="flex-grow-1">
                        <small class="text-muted">{{ $card['title'] }}</small>
                        <div class="h4 mb-0">
                            <span class="countup" data-target="{{ $card['value'] }}">{{ $card['value'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- ================= Main Row: Charts + Sidebar ================= --}}
<div class="row g-4">
    {{-- Left: Line chart + table --}}
    <div class="col-lg-8">
        {{-- Line Chart Card --}}
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-header bg-white fw-bold">
                <i class="bi bi-graph-up me-1 text-primary"></i> Grafik Pertumbuhan Santri
                <small class="text-muted ms-2">(Per bulan)</small>
            </div>
            <div class="card-body">
                <canvas id="santriChart" height="120"></canvas>
            </div>
        </div>

        {{-- Recent activity / quick list --}}
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-header bg-white fw-bold">
                <i class="bi bi-clock-history me-1 text-muted"></i> Aktivitas Terbaru
            </div>
            <div class="card-body">
                {{-- jika $activities dikirim dari controller, gunakan itu; contoh format: collection of objects with user.name, action, created_at --}}
                @if(isset($activities) && $activities->isNotEmpty())
                    <ul class="list-group list-group-flush">
                        @foreach($activities as $act)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fw-semibold">{{ $act->user->name ?? 'System' }}</div>
                                    <div class="small text-muted">{{ $act->action ?? $act->aksi ?? '—' }}</div>
                                </div>
                                <div class="small text-muted">{{ \Carbon\Carbon::parse($act->created_at)->diffForHumans() }}</div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-center text-muted mb-0">Belum ada aktivitas terbaru.</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Right: Pie + Calendar + Shortcuts --}}
    <div class="col-lg-4">
        {{-- Pie chart --}}
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-header bg-white fw-bold">
                <i class="bi bi-pie-chart me-1 text-success"></i> Komposisi Data
            </div>
            <div class="card-body text-center">
                <canvas id="pieChart" height="180"></canvas>
                <div class="mt-3 d-flex justify-content-center gap-2 flex-wrap">
                    <small class="text-muted"><span class="badge bg-primary">&nbsp;</span> Santri</small>
                    <small class="text-muted"><span class="badge bg-success">&nbsp;</span> Ustadz</small>
                    <small class="text-muted"><span class="badge bg-warning">&nbsp;</span> Kelas</small>
                    <small class="text-muted"><span class="badge bg-danger">&nbsp;</span> Pelajaran</small>
                </div>
            </div>
        </div>

        {{-- Calendar (FullCalendar placeholder) --}}
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-header bg-white fw-bold">
                <i class="bi bi-calendar-event me-1 text-info"></i> Kalender Kegiatan
            </div>
            <div class="card-body">
                <div id="calendar"></div>
            </div>
        </div>

        {{-- Quick Shortcuts --}}
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body d-flex flex-column gap-2">
                <a href="{{ route('admin.ustadz.index') }}" class="btn btn-outline-primary btn-sm w-100">
                    <i class="bi bi-person-lines-fill me-1"></i> Data Ustadz
                </a>
                <a href="{{ route('admin.santri.index') }}" class="btn btn-outline-success btn-sm w-100">
                    <i class="bi bi-mortarboard me-1"></i> Data Santri
                </a>
                <a href="{{ route('admin.kelas.index') }}" class="btn btn-outline-warning btn-sm w-100">
                    <i class="bi bi-book-half me-1"></i> Data Pelajaran
                </a>
                <a href="{{ route('admin.kelas.index') }}" class="btn btn-outline-danger btn-sm w-100">
                    <i class="bi bi-door-open me-1"></i> Data Kelas
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Optional Livewire loading (if you use Livewire components) --}}
<div wire:loading class="position-fixed bottom-0 end-0 m-4">
    <div class="spinner-border text-primary" role="status"></div>
</div>
@endsection

@section('scripts')
{{-- === Libraries (CDN) === --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/countup.js@2.0.7/dist/countUp.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- FullCalendar (CDN) --}}
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ===== CountUp animation for summary cards =====
    document.querySelectorAll('.countup').forEach(el => {
        const target = parseInt(el.getAttribute('data-target')) || parseInt(el.textContent) || 0;
        const cu = new countUp.CountUp(el, target, { duration: 1.2, separator: ',' });
        if (!cu.error) cu.start(); else console.error(cu.error);
    });

    // ===== Line Chart (Santri per bulan) =====
    // Controller should pass $months (array of labels) and $santriCounts (array of numbers)
    const months = {!! json_encode($months ?? ['Jan','Feb','Mar','Apr','Mei','Jun']) !!};
    const santriCounts = {!! json_encode($santriCounts ?? [10,20,15,25,30,40]) !!};
    const ctx = document.getElementById('santriChart').getContext('2d');
    const santriChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Jumlah Santri',
                data: santriCounts,
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78,115,223,0.12)',
                fill: true,
                tension: 0.35,
                pointRadius: 4,
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } },
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // ===== Pie Chart (composition) =====
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    const pie = new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: ['Santri','Ustadz','Pelajaran','Kelas'],
            datasets: [{
                data: [{{ $totalSantri ?? 0 }}, {{ $totalUstadz ?? 0 }}, {{ $totalPelajaran ?? 0 }}, {{ $totalKelas ?? 0 }}],
                backgroundColor: ['#4e73df','#1cc88a','#f6c23e','#e74a3b']
            }]
        },
        options: {
            plugins: { legend: { position: 'bottom' } },
            cutout: '70%',
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // ===== FullCalendar init (example events) =====
    const calendarEl = document.getElementById('calendar');
    if (calendarEl) {
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'listWeek',
            height: 420,
            headerToolbar: {
                left: '',
                center: 'title',
                right: 'prev,next'
            },
            events: {!! json_encode($calendarEvents ?? [
                ['title'=>'Ujian Tengah Semester','start'=>now()->addDays(2)->toDateString()],
                ['title'=>'Rapat Guru','start'=>now()->addDays(5)->toDateString()]
            ]) !!},
        });
        calendar.render();
    }

    // ===== SweetAlert2 Notification demo (simulate realtime) =====
    document.getElementById('notifyTest')?.addEventListener('click', () => {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'Contoh: Data berhasil disimpan',
            showConfirmButton: false,
            timer: 2500
        });
    });

    // ===== Theme toggle (light/dark) using localStorage =====
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');
    const root = document.documentElement;
    const savedTheme = localStorage.getItem('dashboard_theme') || 'light';

    const applyTheme = (t) => {
        if (t === 'dark') {
            root.classList.add('dark-mode');
            themeIcon.className = 'bi bi-sun-fill';
        } else {
            root.classList.remove('dark-mode');
            themeIcon.className = 'bi bi-moon-fill';
        }
        localStorage.setItem('dashboard_theme', t);
    };
    applyTheme(savedTheme);

    themeToggle?.addEventListener('click', () => {
        const next = localStorage.getItem('dashboard_theme') === 'dark' ? 'light' : 'dark';
        applyTheme(next);
    });

});
</script>

{{-- === Styling & dark-mode styles === --}}
<style>
    /* hover card */
    .hover-card { transition: all 0.28s ease; }
    .hover-card:hover { transform: translateY(-6px); box-shadow: 0 12px 30px rgba(13,110,253,0.06); }

    /* small polish */
    .card-header { border-bottom: 1px solid #f8f9fb; }

    /* dark-mode variables */
    .dark-mode {
        --bg: #0b1220;
        --card: #0f1724;
        --text: #e6eef8;
        --muted: #9fb0c8;
    }
    .dark-mode body { background: var(--bg); color: var(--text); }
    .dark-mode .card { background: var(--card); color: var(--text); border-color: rgba(255,255,255,0.03); }
    .dark-mode .text-muted { color: var(--muted) !important; }

        /* === Tambahan fix untuk dark mode tabel & card === */
    .dark-mode table,
    .dark-mode .table {
        background-color: var(--card) !important;
        color: var(--text) !important;
        border-color: rgba(255,255,255,0.05) !important;
    }

    .dark-mode thead,
    .dark-mode .table thead th {
        background-color: #1a2333 !important;
        color: var(--text) !important;
        border-bottom-color: rgba(255,255,255,0.08) !important;
    }

    .dark-mode tbody tr:nth-child(even) {
        background-color: rgba(255,255,255,0.02) !important;
    }

    .dark-mode .card-header {
        background-color: #1a2333 !important;
        color: var(--text) !important;
        border-bottom-color: rgba(255,255,255,0.08) !important;
    }


    /* Fix chart height supaya nggak melar */
#santriChart {
    height: 280px !important;
    max-height: 280px !important;
}
#pieChart {
    height: 220px !important;
    max-height: 220px !important;
}
.card-body canvas {
    display: block;
    width: 100% !important;
    height: auto;
}

</style>
@endsection
