<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'), 
        ]);
        $this->call([
            UserSeeder::class,
            ClienteSeeder::class,
            EstabelecimentoSeeder::class,
            ContaBancariaSeeder::class,

        ]);
    }
}
