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
        $user = Auth::user();
        $ustadz = \App\Models\Ustadz::where('user_id', $user->id)->first();
        
        if ($ustadz) {
            $this->jadwal = JadwalModel::where('ustadz_id', $ustadz->id)
                ->orderBy('tanggal', 'asc')
                ->get();
        } else {
            $this->jadwal = [];
        }
    }

    public function render()
    {
        return view('livewire.ustadz.jadwal')
                ->layout('layouts.dashboardustadz', ['title' => $this->title]);
    }
}
