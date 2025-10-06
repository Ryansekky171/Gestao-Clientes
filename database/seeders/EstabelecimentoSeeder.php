<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estabelecimento;
use App\Models\Cliente;
use Faker\Factory as Faker;

class EstabelecimentoSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('pt_BR');
        $clientes = Cliente::all();

        if ($clientes->isEmpty()) {
            $this->command->warn('Nenhum cliente encontrado. Rode o ClienteSeeder antes do EstabelecimentoSeeder.');
            return;
        }

        foreach ($clientes as $cliente) {
            $quantidade = rand(1, 3);
            for ($i = 0; $i < $quantidade; $i++) {
                Estabelecimento::create([
                    'nome_fantasia' => $faker->company,
                    'razao_social' => $faker->company . ' LTDA',
                    'cnpj' => $faker->unique()->numerify('##############'),
                    'cliente_id' => $cliente->id,
                ]);
            }
        }

        $this->command->info('Estabelecimentos gerados com sucesso!');
    }
}
