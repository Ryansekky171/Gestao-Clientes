<?php

namespace Database\Factories;

use App\Models\Estabelecimento;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContaBancariaFactory extends Factory
{
    public function definition()
    {
        $tipos = ['corrente', 'poupanca'];

        return [
            'banco' => $this->faker->randomElement(['Banco do Brasil', 'Caixa Econômica', 'Bradesco', 'Itaú', 'Santander']),
            'agencia' => str_pad($this->faker->numberBetween(1000, 9999), 4, '0', STR_PAD_LEFT),
            'conta' => $this->faker->bankAccountNumber(),
            'tipo' => $this->faker->randomElement($tipos),
            'estabelecimento_id' => Estabelecimento::inRandomOrder()->value('id') ?? 1,
        ];
    }
}
