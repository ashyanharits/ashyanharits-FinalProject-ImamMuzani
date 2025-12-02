<?php

namespace App\Http\Livewire\Ustadz;

use Livewire\Component;
use App\Models\Jadwal as JadwalModel; // alias supaya tidak bentrok
use Illuminate\Support\Facades\Auth;

class Jadwal extends Component
{
    public $title = 'Jadwal Mengajar';
    public $jadwal;

    public function mount()
    {
        $ustadzId = Auth::user()->id;

        // Ambil jadwal untuk ustadz yang login
        $this->jadwal = JadwalModel::where('ustadz_id', $ustadzId)
            ->orderBy('tanggal', 'asc')
            ->get();
    }

    public function render()
    {
        return view('livewire.ustadz.jadwal')
                ->layout('layouts.dashboardustadz', ['title' => $this->title]);
    }
}
