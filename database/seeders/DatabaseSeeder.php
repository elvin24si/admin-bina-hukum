<?php
namespace Database\Seeders;

use App\Models\User;
use DokumenHukumSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use JenisDokumenSeeder;
use KategoriDokumenSeeder;
use WargaSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            CreateFirstUser::class,
            CreateUserDummy::class,
            JenisDokumenSeeder::class,
            KategoriDokumenSeeder::class,
            DokumenHukumSeeder::class,
            WargaSeeder::class
        ]);

        User::factory()->create([
            'name'  => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
