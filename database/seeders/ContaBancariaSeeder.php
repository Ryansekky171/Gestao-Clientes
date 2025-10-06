<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContaBancaria;

class ContaBancariaSeeder extends Seeder
{
    public function run()
    {
        ContaBancaria::factory()->count(30)->create();
    }
}
