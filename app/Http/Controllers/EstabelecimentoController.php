<?php

namespace App\Http\Controllers;

use App\Models\Estabelecimento;
use App\Models\Cliente;
use Illuminate\Http\Request;

class EstabelecimentoController extends Controller
{
    public function index(Request $request)
    {
        $query = Estabelecimento::with('cliente');

        if ($request->filled('search')) {
            $query->where('nome_fantasia', 'ilike', "%{$request->search}%")
                  ->orWhere('cnpj', 'ilike', "%{$request->search}%");
        }

        $estabelecimentos = $query->orderBy('id', 'Asc')->paginate(10);
        return view('estabelecimentos.index', compact('estabelecimentos'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nome')->get();
        return view('estabelecimentos.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome_fantasia' => 'required|string|max:255',
            'razao_social' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18|unique:estabelecimentos,cnpj',
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        Estabelecimento::create($validated);
        return redirect()->route('estabelecimentos.index')->with('success', 'Estabelecimento criado com sucesso!');
    }

    public function edit(Estabelecimento $estabelecimento)
    {
        $clientes = Cliente::orderBy('nome')->get();
        return view('estabelecimentos.edit', compact('estabelecimento', 'clientes'));
    }

    public function update(Request $request, Estabelecimento $estabelecimento)
    {
        $validated = $request->validate([
            'nome_fantasia' => 'required|string|max:255',
            'razao_social' => 'required|string|max:255',
            'cnpj' => 'required|string|max:18|unique:estabelecimentos,cnpj,' . $estabelecimento->id,
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        $estabelecimento->update($validated);
        return redirect()->route('estabelecimentos.index')->with('success', 'Estabelecimento atualizado com sucesso!');
    }

    public function destroy(Estabelecimento $estabelecimento)
    {
        $estabelecimento->delete();
        return redirect()->route('estabelecimentos.index')->with('success', 'Estabelecimento excluído com sucesso!');
    }
    public function search(Request $request)
{
    $term = $request->get('term', '');

    $results = Estabelecimento::where('nome_fantasia', 'ilike', "%{$term}%")
        ->orWhere('cnpj', 'ilike', "%{$term}%")
        ->limit(10)
        ->get(['id', 'nome_fantasia', 'cnpj']);

    return response()->json($results);
}



}
