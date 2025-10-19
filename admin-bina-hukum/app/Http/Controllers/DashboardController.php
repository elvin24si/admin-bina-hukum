<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Jenis_dokumen; // make sure the model name matches your file name
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with Warga and Jenis Dokumen data.
     */
    public function index()
    {
        // Fetch all data (you can later add pagination if needed)
        $data['dataWarga'] = Warga::all();
        $data['dataJenisDokumen'] = Jenis_dokumen::all();

        // Pass both to the dashboard view
        return view('index', $data);
    }
}
