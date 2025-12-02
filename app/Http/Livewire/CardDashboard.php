<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Santri;
use App\Models\Ustadz;
use App\Models\Kelas;
use App\Models\Pelajaran;

class CardDashboard extends Component
{
    public function render()
    {
        $totalSantri = Santri::count();
        $totalUstadz = Ustadz::count();
        $totalKelas = Kelas::count();
        $totalPelajaran = Kelas::count();

        return view('livewire.card-dashboard', [
            'totalSantri' => $totalSantri,
            'totalUstadz' => $totalUstadz,
            'totalKelas' => $totalKelas,
            'totalPelajaran' => $totalPelajaran,
        ]);
    }
}
