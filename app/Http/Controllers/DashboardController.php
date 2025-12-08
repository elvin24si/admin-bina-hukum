<?php

namespace App\Http\Controllers;

use App\Models\DokumenHukum;
use App\Models\Warga;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if (! Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Silahkan login terlebih dahulu.');
        }

        // ---------- DATA FOR TABLE ----------
        $data['dataWarga'] = Warga::orderBy('created_at', 'desc')->get();

        $data['dataDokumenHukum'] = DokumenHukum::orderBy('created_at', 'desc')
            ->paginate(10);

        // ---------- DATA FOR CHARTS ----------
        // Warga by Gender
        $data['genderCounts'] = Warga::select('jenis_kelamin', DB::raw('COUNT(*) as total'))
            ->groupBy('jenis_kelamin')
            ->pluck('total', 'jenis_kelamin');

        // Warga by Agama
        $data['religionCounts'] = Warga::select('agama', DB::raw('COUNT(*) as total'))
            ->groupBy('agama')
            ->pluck('total', 'agama');

        // Dokumen Hukum by Status
        $data['statusCounts'] = DokumenHukum::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('admin.pages.dashboard', $data);
    }
}
