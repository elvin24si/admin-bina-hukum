<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\CreateFirstUser;
use Database\Seeders\CreateUserDummy;
use Database\Seeders\KategoriDokumenSeeder;
use Database\Seeders\JenisDokumenSeeder;
use Database\Seeders\DokumenHukumSeeder;
use Database\Seeders\WargaSeeder;

use App\Models\User;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            CreateFirstUser::class,
            CreateUserDummy::class,
            KategoriDokumenSeeder::class,
            JenisDokumenSeeder::class,
            DokumenHukumSeeder::class,
            WargaSeeder::class,
        ]);

        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
