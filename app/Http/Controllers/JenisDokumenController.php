<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumen;
use Illuminate\Http\Request;

class JenisDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchableColumns = ['nama_jenis', 'deskripsi'];

        $data['dataJenisDokumen'] = JenisDokumen::search($request, $searchableColumns)
            ->paginate(10)
            ->withQueryString();

        return view('admin.pages.jenis_dokumen.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.jenis_dokumen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jenis' => 'required|string|unique:jenis_dokumen,nama_jenis|max:255',
            'deskripsi'  => 'nullable|string',
        ]);

        JenisDokumen::create($validated);

        return redirect()->route('jenis_dokumen.index')
            ->with('success', 'Jenis dokumen berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['jenisDokumen'] = JenisDokumen::findOrFail($id);
        return view('admin.pages.jenis_dokumen.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jenisDokumen = JenisDokumen::findOrFail($id);

        $validated = $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:jenis_dokumen,nama_jenis,' . $jenisDokumen->jenis_id . ',jenis_id',
            'deskripsi'  => 'nullable|string',
        ]);

        $jenisDokumen->update($validated);

        return redirect()->route('jenis_dokumen.index')
            ->with('success', 'Jenis dokumen berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenisDokumen = JenisDokumen::findOrFail($id);
        $jenisDokumen->delete();

        return redirect()->route('jenis_dokumen.index')
            ->with('success', 'Jenis dokumen berhasil dihapus!');
    }
}
