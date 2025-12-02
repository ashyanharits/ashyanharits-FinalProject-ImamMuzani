<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Santri;
use App\Models\Ustadz;
use Illuminate\Http\Request;

class SantriController extends Controller
{
    // Tampil daftar santri
    public function index()
    {
        $santri = Santri::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.santri.index', compact('santri'));
    }

    // Form tambah santri
    public function create()
    {
        $ustadz = Ustadz::orderBy('nama', 'asc')->get();
        return view('admin.santri.create', compact('ustadz'));
    }

    // Simpan data santri baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'kelas' => 'nullable|string|max:50',
            'no_hp' => 'nullable|string|max:20',
            'ustadz_id' => 'required|exists:ustadz,id',
        ]);

        Santri::create($request->all());

        return redirect()->route('admin.santri.index')
                         ->with('success', 'Data santri berhasil ditambahkan!');
    }

    // Form edit santri
    public function edit($id)
    {
        $santri = Santri::findOrFail($id);
        $ustadz = Ustadz::orderBy('nama', 'asc')->get();
        return view('admin.santri.edit', compact('santri', 'ustadz'));
    }

    // Update data santri
    public function update(Request $request, $id)
    {
        $santri = Santri::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'kelas' => 'nullable|string|max:50',
            'no_hp' => 'nullable|string|max:20',
            'ustadz_id' => 'required|exists:ustadz,id',
        ]);

        $santri->update($request->all());

        return redirect()->route('admin.santri.index')
                         ->with('success', 'Data santri berhasil diupdate!');
    }

    // Hapus data santri
    public function destroy($id)
    {
        $santri = Santri::findOrFail($id);
        $santri->delete();

        return redirect()->route('admin.santri.index')
                         ->with('success', 'Data santri berhasil dihapus!');
    }
}
