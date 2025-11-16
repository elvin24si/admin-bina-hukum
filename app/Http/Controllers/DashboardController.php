<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\JenisDokumen;
use App\Models\KategoriDokumen;
use App\Models\DokumenHukum;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['dataWarga'] = Warga::all();
        $data['dataJenisDokumen'] = JenisDokumen::all();
        $data['dataKategoriDokumen'] = KategoriDokumen::all();
        $data['dataDokumenHukum'] = DokumenHukum::all();

        return view('admin.pages.dashboard', $data);
    }
}
