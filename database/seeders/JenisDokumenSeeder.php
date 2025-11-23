<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class JenisDokumenSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 100; $i++) {
            DB::table('jenis_dokumen')->insert([
                'nama_jenis' => ucfirst($faker->words(2, true)),
                'deskripsi'  => $faker->sentence(10),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
