<?php

namespace App\Http\Controllers;

use App\Models\DokumenHukum;
use App\Models\JenisDokumen;
use App\Models\KategoriDokumen;
use Illuminate\Http\Request;

class DokumenHukumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Load relational data (jenis + kategori)
        $data['dataDokumenHukum'] = DokumenHukum::with(['jenis', 'kategori'])
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.pages.dokumen_hukum.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Data for dropdowns
        $data['listJenis'] = JenisDokumen::all();
        $data['listKategori'] = KategoriDokumen::all();

        return view('admin.pages.dokumen_hukum.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_id'    => 'required|exists:jenis_dokumen,jenis_id',
            'kategori_id' => 'required|exists:kategori_dokumen,kategori_id',
            'nomor'       => 'required|string|max:255|unique:dokumen_hukum,nomor',
            'judul'       => 'required|string|max:255',
            'tanggal'     => 'nullable|date',
            'ringkasan'   => 'nullable|string',
            'status'      => 'required|string|max:50',
        ]);

        DokumenHukum::create($validated);

        return redirect()->route('dokumen_hukum.index')
            ->with('success', 'Dokumen hukum berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dokumen'] = DokumenHukum::findOrFail($id);
        $data['listJenis'] = JenisDokumen::all();
        $data['listKategori'] = KategoriDokumen::all();

        return view('admin.pages.dokumen_hukum.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dokumen = DokumenHukum::findOrFail($id);

        $validated = $request->validate([
            'jenis_id'    => 'required|exists:jenis_dokumen,jenis_id',
            'kategori_id' => 'required|exists:kategori_dokumen,kategori_id',
            'nomor'       => 'required|string|max:255|unique:dokumen_hukum,nomor,' . $dokumen->dokumen_id . ',dokumen_id',
            'judul'       => 'required|string|max:255',
            'tanggal'     => 'nullable|date',
            'ringkasan'   => 'nullable|string',
            'status'      => 'required|string|max:50',
        ]);

        $dokumen->update($validated);

        return redirect()->route('dokumen_hukum.index')
            ->with('success', 'Dokumen hukum berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dokumen = DokumenHukum::findOrFail($id);
        $dokumen->delete();

        return redirect()->route('dokumen_hukum.index')
            ->with('success', 'Dokumen hukum berhasil dihapus!');
    }
}
