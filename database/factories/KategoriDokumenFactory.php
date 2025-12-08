<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KategoriDokumenFactory extends Factory
{
    public function definition(): array
    {
        // You can provide a predefined set of meaningful names
        $names = [
            'Keuangan',
            'SDM',
            'Pengadaan',
            'Operasional',
            'Laporan Tahunan',
            'Hukum & Legal',
            'Perencanaan',
            'Audit',
            'Pemasaran',
            'Teknologi Informasi',
            'Inventaris',
            'Kearsipan',
            'Proyek',
            'Manajemen Risiko',
            'Pendidikan & Pelatihan',
            'Kesehatan & Keselamatan Kerja',
            'Kebijakan & SOP',
            'Riset & Pengembangan',
            'Hubungan Masyarakat',
            'Pengawasan Internal',
            'Lingkungan & K3',
            'Kepatuhan (Compliance)',
            'Aset & Properti',
            'Transportasi & Logistik',
            'Produksi & Manufaktur',
            'Quality Control',
            'Pengembangan Organisasi',
            'Kerjasama & Kemitraan',
            'Dokumen Strategis',
            'Komunikasi Internal'
        ];

        $nama = $this->faker->unique()->randomElement($names);

        return [
            'nama' => $nama,
            'deskripsi' => "Dokumen terkait {$nama} dan seluruh kebutuhan administratifnya.",
        ];
    }
}
