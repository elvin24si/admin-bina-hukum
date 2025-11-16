<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisDokumen;

class CreateJenisDokumen extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisDokumen::create([
            'nama_jenis' => 'Peraturan Desa',
            'deskripsi' => 'Dokumen hukum berupa peraturan yang ditetapkan oleh Kepala Desa dan BPD.',
        ]);

    }
}
