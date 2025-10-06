<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cliente;
use App\Models\Estabelecimento;
use App\Models\ContaBancaria;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClientes = Cliente::count();
        $totalEstabelecimentos = Estabelecimento::count();
        $totalContas = ContaBancaria::count();
        $totalUsuarios = User::count();

        return view('dashboard', compact(
            'totalClientes',
            'totalEstabelecimentos',
            'totalContas',
            'totalUsuarios'
        ));
    }
}
