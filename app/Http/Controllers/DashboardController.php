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
        $data['dataWarga'] = Warga::paginate(10);
        $data['dataDokumenHukum'] = DokumenHukum::paginate(10);

        return view('admin.pages.dashboard', $data);
    }
}
