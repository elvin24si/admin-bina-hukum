<?php
namespace App\Http\Controllers;

use App\Models\KategoriDokumen;
use Illuminate\Http\Request;

class KategoriDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchableColumns = ['nama', 'deskripsi'];

        $data['dataKategoriDokumen'] = KategoriDokumen::search($request, $searchableColumns)
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.pages.kategori_dokumen.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.kategori_dokumen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255|unique:kategori_dokumen,nama',
            'deskripsi' => 'nullable|string',
        ]);

        KategoriDokumen::create($validated);

        return redirect()->route('kategori_dokumen.index')
            ->with('success', 'Kategori dokumen berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['kategoriDokumen'] = KategoriDokumen::findOrFail($id);
        return view('admin.pages.kategori_dokumen.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategoriDokumen = KategoriDokumen::findOrFail($id);

        $validated = $request->validate([
            'nama'      => 'required|string|max:255|unique:kategori_dokumen,nama,' . $kategoriDokumen->kategori_id . ',kategori_id',
            'deskripsi' => 'nullable|string',
        ]);

        $kategoriDokumen->update($validated);

        return redirect()->route('kategori_dokumen.index')
            ->with('success', 'Kategori dokumen berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategoriDokumen = KategoriDokumen::findOrFail($id);
        $kategoriDokumen->delete();

        return redirect()->route('kategori_dokumen.index')
            ->with('success', 'Kategori dokumen berhasil dihapus!');
    }
}
