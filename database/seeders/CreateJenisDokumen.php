<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisDokumen;

class CreateJenisDokumen extends Seeder
{
    public function run(): void
    {
        JenisDokumen::factory()->count(30)->create();
    }
}
