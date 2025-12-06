<?php

namespace App\Http\Livewire\Ustadz;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Santri;
use App\Models\Hafalan as HafalanModel;
use Illuminate\Support\Facades\Auth;

class Hafalan extends Component
{
    use WithPagination;

    public $title = 'Manajemen Hafalan';
    public $search = '';
    
    // State
    public $selectedSantriId = null;
    public $isDetailMode = false;

    // Form Inputs
    public $tanggal;
    public $juz;
    public $surat; // Maps to nama_hafalan
    public $halaman; // Manual input
    public $jenis_input = 'halaman'; // 'halaman' or 'baris'
    public $total_halaman;
    public $total_baris;
    public $catatan_ustadz;
    public $status = 'lancar'; // Default status

    protected $rules = [
        'tanggal' => 'required|date',
        'juz' => 'required|integer|min:1|max:30',
        'surat' => 'required|string',
        'halaman' => 'required|string',
        'jenis_input' => 'required|in:halaman,baris',
        'total_halaman' => 'nullable|required_if:jenis_input,halaman|integer|min:1|max:20',
        'total_baris' => 'nullable|required_if:jenis_input,baris|integer|min:1|max:15',
        'catatan_ustadz' => 'nullable|string|max:500',
    ];

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
    }

    public function render()
    {
        $user = Auth::user();
        // Cari ustadz berdasarkan nama user
        $ustadz = \App\Models\Ustadz::where('user_id', $user->id)->first();
        $ustadzId = $ustadz ? $ustadz->id : $user->id; // Fallback

        if ($this->isDetailMode && $this->selectedSantriId) {
            $santri = Santri::with(['hafalan' => function($q) {
                $q->latest('tanggal');
            }])->find($this->selectedSantriId);
            
            return view('livewire.ustadz.hafalan', [
                'santri' => $santri,
                'surahs' => $this->getSurahList()
            ])->layout('layouts.dashboardustadz', ['title' => $this->title]);
        }

        $santris = Santri::where('ustadz_id', $ustadzId)
            ->where('nama', 'like', '%' . $this->search . '%')
            ->orderBy('nama')
            ->paginate(10);

        return view('livewire.ustadz.hafalan', [
            'santris' => $santris
        ])->layout('layouts.dashboardustadz', ['title' => $this->title]);
    }

    public function selectSantri($id)
    {
        $this->selectedSantriId = $id;
        $this->isDetailMode = true;
        $this->resetForm();
    }

    public function backToList()
    {
        $this->isDetailMode = false;
        $this->selectedSantriId = null;
        $this->resetForm();
    }

    public function store()
    {
        $this->validate();

        $user = Auth::user();
        $ustadz = \App\Models\Ustadz::where('user_id', $user->id)->first();
        $ustadzId = $ustadz ? $ustadz->id : $user->id;

        HafalanModel::create([
            'santri_id' => $this->selectedSantriId,
            'ustadz_id' => $ustadzId,
            'nama_hafalan' => $this->surat,
            'juz' => $this->juz,
            'halaman' => $this->halaman,
            'total_halaman' => $this->jenis_input == 'halaman' ? $this->total_halaman : null,
            'total_baris' => $this->jenis_input == 'baris' ? $this->total_baris : null,
            'status' => $this->status,
            'tanggal' => $this->tanggal,
            'catatan_ustadz' => $this->catatan_ustadz,
        ]);

        session()->flash('message', 'Hafalan berhasil ditambahkan!');
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->tanggal = date('Y-m-d');
        $this->juz = '';
        $this->surat = '';
        $this->halaman = '';
        $this->jenis_input = 'halaman';
        $this->total_halaman = '';
        $this->total_baris = '';
        $this->catatan_ustadz = '';
    }

    private function getSurahList()
    {
        return [
            "Al-Fatihah", "Al-Baqarah", "Ali 'Imran", "An-Nisa'", "Al-Ma'idah", "Al-An'am", "Al-A'raf", "Al-Anfal", "At-Taubah", "Yunus",
            "Hud", "Yusuf", "Ar-Ra'd", "Ibrahim", "Al-Hijr", "An-Nahl", "Al-Isra'", "Al-Kahf", "Maryam", "Ta-Ha",
            "Al-Anbiya'", "Al-Hajj", "Al-Mu'minun", "An-Nur", "Al-Furqan", "Ash-Shu'ara'", "An-Naml", "Al-Qasas", "Al-Ankabut", "Ar-Rum",
            "Luqman", "As-Sajdah", "Al-Ahzab", "Saba'", "Fatir", "Ya-Sin", "As-Saffat", "Sad", "Az-Zumar", "Ghafir",
            "Fussilat", "Ash-Shura", "Az-Zukhruf", "Ad-Dukhan", "Al-Jathiyah", "Al-Ahqaf", "Muhammad", "Al-Fath", "Al-Hujurat", "Qaf",
            "Adh-Dhariyat", "At-Tur", "An-Najm", "Al-Qamar", "Ar-Rahman", "Al-Waqi'ah", "Al-Hadid", "Al-Mujadila", "Al-Hashr", "Al-Mumtahanah",
            "As-Saff", "Al-Jumu'ah", "Al-Munafiqun", "At-Taghabun", "At-Talaq", "At-Tahrim", "Al-Mulk", "Al-Qalam", "Al-Haqqah", "Al-Ma'arij",
            "Nuh", "Al-Jinn", "Al-Muzzammil", "Al-Muddaththir", "Al-Qiyamah", "Al-Insan", "Al-Mursalat", "An-Naba'", "An-Nazi'at", "'Abasa",
            "At-Takwir", "Al-Infitar", "Al-Mutaffifin", "Al-Inshiqaq", "Al-Buruj", "At-Tariq", "Al-A'la", "Al-Ghashiyah", "Al-Fajr", "Al-Balad",
            "Ash-Shams", "Al-Layl", "Ad-Duha", "Ash-Sharh", "At-Tin", "Al-'Alaq", "Al-Qadr", "Al-Bayyinah", "Az-Zalzalah", "Al-'Adiyat",
            "Al-Qari'ah", "At-Takathur", "Al-'Asr", "Al-Humazah", "Al-Fil", "Quraysh", "Al-Ma'un", "Al-Kawthar", "Al-Kafirun", "An-Nasr",
            "Al-Masad", "Al-Ikhlas", "Al-Falaq", "An-Nas"
        ];
    }
}
