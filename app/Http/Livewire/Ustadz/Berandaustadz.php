<?php

namespace App\Http\Livewire\Ustadz;

use Livewire\Component;
use App\Models\Santri;
use App\Models\Hafalan;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Berandaustadz extends Component
{
    public $totalSantri;
    public $hafalanBaru;
    public $jadwalHariIni;
    public $progressHafalan;
    public $motivasi;
    public $chartData;
    public $santriButuhPerhatian;

    public function mount()
    {
        $user = Auth::user();
        // Asumsi: user login terhubung ke tabel ustadz via relasi atau kita cari manual
        // Karena belum ada relasi resmi di User model, kita cari ustadz berdasarkan nama atau email yang sama, 
        // atau sementara kita pakai id user jika asumsinya id user == id ustadz (seperti kode sebelumnya).
        // Untuk keamanan, kita coba cari Ustadz yang namanya mirip user login, atau fallback ke ID.
        
        $ustadz = \App\Models\Ustadz::where('nama', $user->name)->first();
        $ustadzId = $ustadz ? $ustadz->id : $user->id; // Fallback

        // 1. Total santri binaan
        $this->totalSantri = Santri::where('ustadz_id', $ustadzId)->count();

        // 2. Hafalan terbaru (Hanya Hari Ini)
        $this->hafalanBaru = Hafalan::with('santri')
            ->where('ustadz_id', $ustadzId)
            ->whereDate('tanggal', Carbon::today())
            ->latest('created_at') // Tetap urutkan berdasarkan waktu input
            ->get();

        // 3. Jadwal hari ini dan mendatang
        $this->jadwalHariIni = Jadwal::where('ustadz_id', $ustadzId)
            ->whereDate('tanggal', '>=', now())
            ->orderBy('tanggal', 'asc')
            ->take(5) // Limit biar gak kepanjangan
            ->get()
            ->map(function($j) {
                $jadwalDate = Carbon::parse($j->tanggal . ' ' . $j->jam_mulai);
                if($jadwalDate->isToday()) {
                    $j->status = 'Hari Ini';
                    $j->badge = 'success';
                } elseif($jadwalDate->isTomorrow()) {
                    $j->status = 'Besok';
                    $j->badge = 'info';
                } else {
                    $j->status = $jadwalDate->format('d M');
                    $j->badge = 'secondary';
                }
                return $j;
            });

        // 4. Progress hafalan (Persentase santri yang sudah setor minimal 1x minggu ini)
        // Kita ubah logikanya jadi "Activity Rate" minggu ini
        $activeSantriCount = Hafalan::where('ustadz_id', $ustadzId)
            ->whereBetween('tanggal', [now()->startOfWeek(), now()->endOfWeek()])
            ->distinct('santri_id')
            ->count('santri_id');
            
        $this->progressHafalan = $this->totalSantri > 0 ? round(($activeSantriCount / $this->totalSantri) * 100) : 0;

        // 5. Statistik Mingguan (7 hari terakhir)
        $this->chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $count = Hafalan::where('ustadz_id', $ustadzId)
                ->whereDate('tanggal', $date)
                ->count();
            $this->chartData[] = [
                'day' => $date->locale('id')->isoFormat('ddd'), // Sen, Sel, etc
                'count' => $count
            ];
        }

        // 6. Santri Butuh Perhatian (Belum setor HARI INI)
        // Ambil semua santri binaan
        $allSantri = Santri::where('ustadz_id', $ustadzId)->orderBy('nama')->get();
        $this->santriButuhPerhatian = collect();
        
        // Ambil ID santri yang SUDAH setor hari ini (Berdasarkan Tanggal Hafalan)
        $santriSudahSetorIds = Hafalan::where('ustadz_id', $ustadzId)
            ->whereDate('tanggal', Carbon::today())
            ->pluck('santri_id')
            ->toArray();

        // Filter santri yang belum setor
        foreach($allSantri as $s) {
            if (!in_array($s->id, $santriSudahSetorIds)) {
                // Tambahkan info terakhir setor kapan
                $lastHafalan = Hafalan::where('santri_id', $s->id)->latest('tanggal')->first();
                $s->last_activity = $lastHafalan ? Carbon::parse($lastHafalan->tanggal)->diffForHumans() : 'Belum pernah';
                $this->santriButuhPerhatian->push($s);
            }
        }
        // Tidak perlu di-limit 5, tampilkan semua yang belum setor agar ustadz tahu target hari ini
        // $this->santriButuhPerhatian = $this->santriButuhPerhatian->take(5);

        // Quote motivasi
        $quotes = [
            "Kesabaran adalah kunci keberhasilan.",
            "Ajarkan dengan hati, bukan hanya dengan kata.",
            "Setiap hari adalah kesempatan untuk menjadi lebih baik.",
            "Hafalan hari ini, keberkahan esok hari.",
            "Ilmu yang diamalkan adalah ilmu yang bermanfaat."
        ];
        $this->motivasi = $quotes[array_rand($quotes)];
    }

    public function render()
    {
        return view('livewire.ustadz.berandaustadz')
            ->layout('layouts.dashboardustadz');
    }
}
