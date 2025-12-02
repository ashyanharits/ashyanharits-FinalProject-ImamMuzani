<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    // Tampil daftar kelas
    public function index()
    {
        $kelas = Kelas::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.kelas.index', compact('kelas'));
    }

    // Form tambah kelas
    public function create()
    {
        return view('admin.kelas.create');
    }

    // Simpan kelas baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'pelajaran' => 'required|string|max:255',
            'wali_kelas' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
            'keterangan' => 'nullable|string',
        ]);

        Kelas::create($request->all());

        return redirect()->route('admin.kelas.index')
                         ->with('success', 'Kelas berhasil ditambahkan!');
    }

    // Form edit kelas
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('admin.kelas.edit', compact('kelas'));
    }

    // Update kelas
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'pelajaran' => 'required|string|max:255',
            'wali_kelas' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
            'keterangan' => 'nullable|string',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->all());

        return redirect()->route('admin.kelas.index')
                         ->with('success', 'Kelas berhasil diperbarui!');
    }

    // Hapus kelas
    public function destroy($id)
    {
        Kelas::destroy($id);
        return redirect()->route('admin.kelas.index')
                         ->with('success', 'Kelas berhasil dihapus!');
    }
}
