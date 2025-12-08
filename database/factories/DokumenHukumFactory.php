<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\JenisDokumen;
use App\Models\KategoriDokumen;

class DokumenHukumFactory extends Factory
{
    public function definition(): array
    {
        // Ensure valid relational data
        $jenis = JenisDokumen::inRandomOrder()->first();
        $kategori = KategoriDokumen::inRandomOrder()->first();

        // Fallback if seeder order is incorrect
        $jenisName = $jenis?->nama_jenis ?? 'Dokumen Umum';
        $kategoriName = $kategori?->nama ?? 'Kategori Umum';

        // Generate meaningful judul
        $judul = "{$jenisName} tentang {$this->faker->words(3, true)}";

        return [
            'jenis_id'    => $jenis?->id ?? 1,
            'kategori_id' => $kategori?->id ?? 1,

            // Format seperti nomor surat resmi
            'nomor' => $this->faker->numerify('0##/###/##'),

            'judul' => $judul,

            'tanggal' => $this->faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),

            // Ringkasan yang sesuai judul
            'ringkasan' => "Dokumen ini berisi ketentuan mengenai {$judul} dalam ruang lingkup {$kategoriName}.",

            'status' => $this->faker->randomElement(['Aktif', 'Tidak Aktif', 'Draft', 'Revisi']),
        ];
    }
}
