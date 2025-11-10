<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Jenis_dokumen;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['dataWarga'] = Warga::all();
        $data['dataJenisDokumen'] = jenis_dokumen::all();

        return view('admin.pages.dashboard', $data);
    }
}
