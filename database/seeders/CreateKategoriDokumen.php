<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KategoriDokumen;

class CreateKategoriDokumen extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'Keuangan',
            'deskripsi' => 'Dokumen terkait anggaran, laporan keuangan, dan pertanggungjawaban.',
        ]);
    }
}
