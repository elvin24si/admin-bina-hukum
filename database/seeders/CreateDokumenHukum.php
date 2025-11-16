<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\DokumenHukum;

class CreateDokumenHukum extends Seeder
{
    public function run(): void
    {
        DokumenHukum::create([
            'jenis_id'    => 1,
            'kategori_id' => 1,
            'nomor'       => '5314103',
            'judul'       => 'Peraturan Desa Tentang Pengelolaan Keuangan Desa',
            'tanggal'     => '2025-11-15',
            'ringkasan'   => 'Peraturan mengenai pertanggungjawaban keuangan desa.',
            'status'      => 'Aktif',
        ]);
    }
}
