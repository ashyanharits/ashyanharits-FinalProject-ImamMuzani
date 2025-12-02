<?php

namespace App\Http\Livewire\Ustadz;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Laporan as LaporanModel;
use Illuminate\Support\Facades\Auth;

class Laporan extends Component
{
    use WithPagination;

    public $title = 'Laporan Ustadz';
    public $search = '';
    
    // Form Inputs
    public $judul;
    public $isi;
    public $tanggal;

    protected $rules = [
        'judul' => 'required|string|max:255',
        'isi' => 'required|string',
        'tanggal' => 'required|date',
    ];

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
    }

    public function render()
    {
        $user = Auth::user();
        
        // Assuming 'penulis' stores the name of the Ustadz
        $laporans = LaporanModel::where('penulis', $user->name)
            ->where('judul', 'like', '%' . $this->search . '%')
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('livewire.ustadz.laporan', [
            'laporans' => $laporans
        ])->layout('layouts.dashboardustadz', ['title' => $this->title]);
    }

    public function store()
    {
        $this->validate();

        $user = Auth::user();

        LaporanModel::create([
            'judul' => $this->judul,
            'isi' => $this->isi,
            'tanggal' => $this->tanggal,
            'penulis' => $user->name,
        ]);

        session()->flash('message', 'Laporan berhasil dibuat!');
        $this->resetForm();
    }

    public function delete($id)
    {
        $laporan = LaporanModel::find($id);
        
        if ($laporan && $laporan->penulis == Auth::user()->name) {
            $laporan->delete();
            session()->flash('message', 'Laporan berhasil dihapus.');
        }
    }

    private function resetForm()
    {
        $this->judul = '';
        $this->isi = '';
        $this->tanggal = date('Y-m-d');
    }
}
