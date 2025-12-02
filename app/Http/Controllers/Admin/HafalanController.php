<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hafalan;
use App\Models\Santri;
use App\Models\Kelas;
use App\Models\Ustadz;
use Illuminate\Http\Request;

class HafalanController extends Controller
{
    public function index()
    {
        $hafalan = Hafalan::with(['santri', 'kelas', 'ustadz'])->orderBy('tanggal','desc')->paginate(10);
        return view('admin.hafalan.index', compact('hafalan'));
    }

    public function create()
    {
        $santri = Santri::all();
        $kelas = Kelas::all();
        $ustadz = Ustadz::all();
        return view('admin.hafalan.create', compact('santri','kelas','ustadz'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'santri_id' => 'required|exists:santri,id',
            'kelas_id' => 'nullable|exists:kelas,id',
            'ustadz_id' => 'nullable|exists:ustadz,id',
            'nama_hafalan' => 'required|string|max:255',
            'status' => 'required|in:belum_mulai,sedang_hafal,selesai',
            'tanggal' => 'required|date',
            'catatan_ustadz' => 'nullable|string'
        ]);

        Hafalan::create($request->all());
        return redirect()->route('admin.hafalan.index')->with('success', 'Data hafalan berhasil ditambahkan!');
    }

    public function edit(Hafalan $hafalan)
    {
        $santri = Santri::all();
        $kelas = Kelas::all();
        $ustadz = Ustadz::all();
        return view('admin.hafalan.edit', compact('hafalan','santri','kelas','ustadz'));
    }

    public function update(Request $request, Hafalan $hafalan)
    {
        $request->validate([
            'santri_id' => 'required|exists:santri,id',
            'kelas_id' => 'nullable|exists:kelas,id',
            'ustadz_id' => 'nullable|exists:ustadz,id',
            'nama_hafalan' => 'required|string|max:255',
            'status' => 'required|in:belum_mulai,sedang_hafal,selesai',
            'tanggal' => 'required|date',
            'catatan_ustadz' => 'nullable|string'
        ]);

        $hafalan->update($request->all());
        return redirect()->route('admin.hafalan.index')->with('success', 'Data hafalan berhasil diupdate!');
    }

    public function destroy(Hafalan $hafalan)
    {
        $hafalan->delete();
        return redirect()->route('admin.hafalan.index')->with('success', 'Data hafalan berhasil dihapus!');
    }
}

