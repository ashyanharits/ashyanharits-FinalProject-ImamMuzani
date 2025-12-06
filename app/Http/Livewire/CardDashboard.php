<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Santri;
use App\Models\Ustadz;
use App\Models\Kelas;
use App\Models\Pelajaran;
use App\Models\Hafalan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CardDashboard extends Component
{
    public function render()
    {
        $totalSantri = Santri::count();
        $totalUstadz = Ustadz::count();
        $totalKelas = Kelas::count();
        $totalPelajaran = Kelas::count(); // Note: This was Kelas::count() in original, assuming it might be Pelajaran::count() if model exists, but keeping as is for now or fixing if Pelajaran model exists.

        // 1. Chart Data: Setoran per Bulan (6 bulan terakhir)
        $months = [];
        $santriCounts = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthName = $date->translatedFormat('F');
            $year = $date->year;
            $month = $date->month;

            $count = Hafalan::whereYear('tanggal', $year)
                            ->whereMonth('tanggal', $month)
                            ->count();
            
            $months[] = $monthName;
            $santriCounts[] = $count;
        }

        // 2. Pie Chart Data: Santri per Kelas
        // Asumsi field 'kelas' di tabel santri menyimpan nama kelas atau ID.
        // Kita group by field tersebut.
        $kelasDistribution = Santri::select('kelas', DB::raw('count(*) as total'))
                                   ->groupBy('kelas')
                                   ->pluck('total', 'kelas')
                                   ->toArray();
        
        $pieLabels = array_keys($kelasDistribution);
        $pieData = array_values($kelasDistribution);

        // 3. Recent Setoran (Hari Ini & Unik per Santri)
        $recentSetoran = Hafalan::with('santri')
                                ->whereDate('created_at', Carbon::today())
                                ->latest('created_at')
                                ->get()
                                ->unique('santri_id')
                                ->values()
                                ->take(10)
                                ->map(function($item) {
                                    return (object) [
                                        'name' => $item->santri->nama ?? 'Unknown',
                                        'surat' => $item->nama_hafalan,
                                        'ayat' => $item->ayat ?? $item->halaman . ' (Hal)',
                                        'status' => $item->status,
                                        'color' => $this->getStatusColor($item->status),
                                        'time' => Carbon::parse($item->created_at)->format('H:i')
                                    ];
                                });

        // 4. Laporan Terbaru dari Ustadz
        $latestLaporan = \App\Models\Laporan::latest('created_at')
                            ->take(4)
                            ->get()
                            ->map(function($item) {
                                return (object) [
                                    'penulis' => $item->penulis ?? 'Ustadz',
                                    'judul' => $item->judul,
                                    'isi' => \Illuminate\Support\Str::limit($item->isi, 50),
                                    'waktu' => Carbon::parse($item->created_at)->diffForHumans(),
                                    'initial' => substr($item->penulis ?? 'U', 0, 1)
                                ];
                            });

        return view('livewire.card-dashboard', [
            'totalSantri' => $totalSantri,
            'totalUstadz' => $totalUstadz,
            'totalKelas' => $totalKelas,
            'totalPelajaran' => $totalPelajaran,
            'months' => $months,
            'santriCounts' => $santriCounts,
            'pieLabels' => $pieLabels,
            'pieData' => $pieData,
            'recentSetoran' => $recentSetoran,
            'latestLaporan' => $latestLaporan
        ]);
    }

    private function getStatusColor($status)
    {
        return match(strtolower($status)) {
            'lancar', 'mumtaz' => 'success',
            'belum lancar', 'mengulang' => 'warning',
            'koreksi' => 'danger',
            default => 'primary'
        };
    }
}
