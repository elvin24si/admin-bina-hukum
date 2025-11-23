<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class KategoriDokumenSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 100; $i++) {
            DB::table('kategori_dokumen')->insert([
                'nama'       => ucfirst($faker->words(2, true)),     // contoh: "Surat Legal", "Berkas Pajak"
                'deskripsi'  => $faker->sentence(12),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
