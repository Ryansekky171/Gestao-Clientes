<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $query = Cliente::query();
        if ($request->filled('nome')) {
            $query->where('nome', 'like', $request->nome . '%');
        }

        if ($request->filled('cpf_cnpj')) {
            $query->where('cpf_cnpj', 'like', '%' . $request->cpf_cnpj . '%');
        }

        $clientes = $query->orderBy('id')->paginate(8);

        return view('clientes.index', compact('clientes'));
    }

    public function search(Request $request)
    {
        $term = $request->get('term', '');

        if (strlen($term) < 3) {
            return response()->json([]);
        }

        $results = Cliente::whereRaw('LOWER(nome) LIKE ?', ['%' . strtolower($term) . '%'])
            ->orderBy('nome')
            ->limit(10)
            ->pluck('nome');

        return response()->json($results);
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf_cnpj' => 'required|string|max:20|unique:clientes,cpf_cnpj',
            'email' => 'nullable|email|max:255',
            'telefone' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
        ]);

        Cliente::create($validated);

        return redirect()->route('clientes.index')->with('success', 'Cliente criado com sucesso!');
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf_cnpj' => 'required|string|max:20|unique:clientes,cpf_cnpj,' . $cliente->id,
            'email' => 'nullable|email|max:255',
            'telefone' => 'nullable|string|max:20',
            'endereco' => 'nullable|string|max:255',
        ]);

        $cliente->update($validated);

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente excluído com sucesso!');
    }
    public function exportarCsv()
    {
        $Cliente = \App\Models\Cliente::all(['nome', 'cpf_cnpj', 'email', 'telefone', 'endereco']);

        $csv = "nome;cpf_cnpj;email;telefone;endereco;";
        foreach ($Cliente as $e) {
            $csv .= "{$e->nome};{$e->cpf_cnpj};{$e->email};{$e->telefone};{$e->endereco};\n";
        }

        $filename = 'Cliente_' . now()->format('Ymd_His') . '.csv';

        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
        ]);
    }

}
