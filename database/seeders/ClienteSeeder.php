<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use Faker\Factory as Faker;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('pt_BR'); 
        $quantidade = 200; 

        for ($i = 0; $i < $quantidade; $i++) {
            $cpf_cnpj = ($i % 2 == 0) 
                ? $faker->unique()->numerify('###########')     
                : $faker->unique()->numerify('##############'); 

            Cliente::create([
                'nome' => $faker->name,
                'cpf_cnpj' => $cpf_cnpj,
                'email' => $faker->unique()->safeEmail,
                'telefone' => $faker->numerify('11#########'), 
                'endereco' => $faker->address,
            ]);
        }
    }
}
