<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DokumenHukumSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // ambil id referensi dari tabel lain
        $jenisIds = DB::table('jenis_dokumen')->pluck('jenis_id')->toArray();
        $kategoriIds = DB::table('kategori_dokumen')->pluck('kategori_id')->toArray();

        for ($i = 0; $i < 100; $i++) {
            DB::table('dokumen_hukum')->insert([
                'jenis_id'   => $faker->randomElement($jenisIds),
                'kategori_id'=> $faker->randomElement($kategoriIds),

                'nomor'      => strtoupper($faker->unique()->bothify('DOC-####/##/##')),
                'judul'      => ucfirst($faker->sentence(4)),
                'tanggal'    => $faker->date(),
                'ringkasan'  => $faker->paragraph(3),
                'status'     => $faker->randomElement(['Aktif', 'Tidak Aktif', 'Revisi', 'Draft']),

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
