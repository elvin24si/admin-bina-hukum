<?php

namespace App\Http\Controllers;

use App\Models\DokumenHukum;
use App\Models\JenisDokumen;
use App\Models\KategoriDokumen;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenHukumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filterableColumns = ['status'];
        $searchableColumns = ['judul', 'ringkasan'];

        $data['dataDokumenHukum'] = DokumenHukum::filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)
            ->withQueryString();

        return view('admin.pages.dokumen_hukum.index', $data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
     *  SHOW DETAIL DOKUMEN + LAMPIRAN
     */
    public function show(string $id)
    {
        $dokumen = DokumenHukum::findOrFail($id);

        $files = Media::where('ref_table', 'dokumen_hukum')
            ->where('ref_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pages.dokumen_hukum.show', compact('dokumen', 'files'));
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

    /**
     *  UPLOAD LAMPIRAN DOKUMEN
     */
    public function uploadFile(Request $request)
    {
        $request->validate([
            'files.*' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx|max:2048',
            'ref_id'  => 'required|integer|exists:dokumen_hukum,dokumen_id',
        ]);

        foreach ($request->file('files') as $file) {
            $path = $file->store('dokumen_hukum', 'public');

            Media::create([
                'ref_table' => 'dokumen_hukum',
                'ref_id'    => $request->ref_id,
                'file_name' => basename($path),
                'caption'   => $file->getClientOriginalName(),
                'mime_type' => $file->getClientMimeType(),
            ]);
        }

        return back()->with('success', 'Lampiran berhasil diupload.');
    }

    /**
     *  DELETE LAMPIRAN
     */
    public function deleteFile($id)
    {
        $file = Media::findOrFail($id);

        Storage::disk('public')->delete('dokumen_hukum/' . $file->file_name);

        $file->delete();

        return back()->with('success', 'Lampiran berhasil dihapus.');
    }
}
