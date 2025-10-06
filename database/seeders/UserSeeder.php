<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin'),
                'type' => 'admin',
            ]
        );

        $users = [
            ['name' => 'Usuário Comum 1', 'email' => 'comum1@gmail.com'],
            ['name' => 'Usuário Comum 2', 'email' => 'comum2@gmail.com'],
            ['name' => 'Usuário Comum 3', 'email' => 'comum3@gmail.com'],
        ];

        foreach ($users as $u) {
            User::updateOrCreate(
                ['email' => $u['email']],
                [
                    'name' => $u['name'],
                    'password' => Hash::make('123456'),
                    'type' => 'comum',
                ]
            );
        }
    }
}
