<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriDokumen;

class CreateKategoriDokumen extends Seeder
{
    public function run(): void
    {
        KategoriDokumen::factory()->count(30)->create();
    }
}
