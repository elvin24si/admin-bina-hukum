<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class WargaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        $agamaList = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
        $pekerjaanList = ['Karyawan Swasta', 'Wiraswasta', 'Guru', 'Petani', 'Mahasiswa', 'PNS', 'Driver', 'Tidak Bekerja'];

        for ($i = 0; $i < 100; $i++) {
            DB::table('warga')->insert([
                'no_ktp'       => $faker->unique()->numerify('################'),   // 16 digit KTP
                'nama'         => $faker->name,
                'jenis_kelamin'=> $faker->randomElement(['Laki-laki', 'Perempuan']),
                'agama'        => $faker->randomElement($agamaList),
                'pekerjaan'    => $faker->randomElement($pekerjaanList),
                'telp'         => $faker->phoneNumber,
                'email'        => $faker->safeEmail,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
