<?php

namespace App\Http\Livewire\Ustadz;

use Livewire\Component;
use App\Models\Santri as SantriModel;

class Santri extends Component
{
    use \Livewire\WithPagination;

    public $title = 'Data Santri Binaan';
    public $search = '';
    
    // Form Properties
    public $nama, $kelas, $no_hp, $santri_id, $alamat, $tanggal_lahir;
    
    // UI State
    public $isModalOpen = false;
    public $isDetailOpen = false;
    public $selectedSantri = null;
    public $viewMode = 'list'; // 'list' or 'grid'

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $ustadz = \App\Models\Ustadz::where('nama', $user->name)->first();
        $ustadzId = $ustadz ? $ustadz->id : $user->id;

        // Query Santri Binaan
        $query = SantriModel::where('ustadz_id', $ustadzId)
            ->where(function($q) {
                $q->where('nama', 'like', '%'.$this->search.'%')
                  ->orWhere('kelas', 'like', '%'.$this->search.'%');
            });

        $santris = $query->orderBy('nama')->paginate(12);

        // Statistik Ringkas
        $totalSantri = SantriModel::where('ustadz_id', $ustadzId)->count();
        $totalKelas = SantriModel::where('ustadz_id', $ustadzId)->distinct('kelas')->count('kelas');
        $santriBaru = SantriModel::where('ustadz_id', $ustadzId)
                        ->whereMonth('created_at', \Carbon\Carbon::now()->month)
                        ->whereYear('created_at', \Carbon\Carbon::now()->year)
                        ->count();

        return view('livewire.ustadz.santri', [
            'santris' => $santris,
            'totalSantri' => $totalSantri,
            'totalKelas' => $totalKelas,
            'santriBaru' => $santriBaru
        ])->layout('layouts.dashboardustadz', ['title' => $this->title]);
    }

    public function toggleViewMode()
    {
        $this->viewMode = $this->viewMode === 'list' ? 'grid' : 'list';
    }

    public function openModal()
    {
        $this->resetInputFields();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->isDetailOpen = false;
    }

    private function resetInputFields()
    {
        $this->nama = '';
        $this->kelas = '';
        $this->no_hp = '';
        $this->alamat = '';
        $this->tanggal_lahir = '';
        $this->santri_id = null;
        $this->selectedSantri = null;
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:50',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
        ]);

        $user = \Illuminate\Support\Facades\Auth::user();
        $ustadz = \App\Models\Ustadz::where('nama', $user->name)->first();
        $ustadzId = $ustadz ? $ustadz->id : $user->id;

        SantriModel::updateOrCreate(
            ['id' => $this->santri_id],
            [
                'nama' => $this->nama,
                'kelas' => $this->kelas,
                'no_hp' => $this->no_hp,
                'alamat' => $this->alamat,
                'tanggal_lahir' => $this->tanggal_lahir,
                'ustadz_id' => $ustadzId // Pastikan terhubung ke ustadz ini
            ]
        );

        session()->flash('message', $this->santri_id ? 'Data santri berhasil diperbarui.' : 'Santri baru berhasil ditambahkan.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $santri = SantriModel::findOrFail($id);
        $this->santri_id = $id;
        $this->nama = $santri->nama;
        $this->kelas = $santri->kelas;
        $this->no_hp = $santri->no_hp;
        $this->alamat = $santri->alamat;
        $this->tanggal_lahir = $santri->tanggal_lahir ? \Carbon\Carbon::parse($santri->tanggal_lahir)->format('Y-m-d') : null;
        $this->isModalOpen = true;
    }

    public function showDetail($id)
    {
        $this->selectedSantri = SantriModel::with(['hafalan' => function($q) {
            $q->latest()->take(5);
        }])->findOrFail($id);
        
        $this->isDetailOpen = true;
    }

    public function delete($id)
    {
        SantriModel::find($id)->delete();
        session()->flash('message', 'Data santri berhasil dihapus.');
    }
}
