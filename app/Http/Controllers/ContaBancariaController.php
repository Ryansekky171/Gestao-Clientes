<?php

namespace App\Http\Controllers;

use App\Models\ContaBancaria;
use App\Models\Estabelecimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ContaBancariaController extends Controller
{

  public function index(Request $request)
  {
    $query = ContaBancaria::with('estabelecimento');
    $termo_aplicado = false;
    if ($request->filled('id') && is_numeric($request->id)) {
      $query->where('id', $request->id);
      $termo_aplicado = true;
    }
    if ($request->filled('term') && !$termo_aplicado) {
      $term = $request->term;

      if (preg_match('/Conta:\s*([\w\-]+)/i', $term, $matches)) {
        $conta_exata = $matches[1];
        $query->where('conta', $conta_exata);
      } else {
        $query->where(function ($q) use ($term) {
          $q->where('banco', 'ilike', "%{$term}%")
            ->orWhere('agencia', 'ilike', "%{$term}%")
            ->orWhere('conta', 'ilike', "%{$term}%");
        });
      }
    }

    $contas = $query->orderBy('id', 'Asc')->paginate(10)->withQueryString();

    return view('contas.index', compact('contas'));
  }

  public function autocomplete(Request $request)
  {
    $term = $request->get('term');
    if (strlen($term) < 3) {
      return response()->json([]);
    }

    $contas = ContaBancaria::with('estabelecimento')
      ->where(function ($query) use ($term) {
        $query->where('banco', 'ilike', '%' . $term . '%')
          ->orWhere('agencia', 'ilike', '%' . $term . '%')
          ->orWhere('conta', 'ilike', '%' . $term . '%');
      })
      ->limit(10)
      ->get();

    // formatar resultados
    $results = $contas->map(function ($conta) {
      return [
        'id' => $conta->id,
        'banco' => $conta->banco,
        'agencia' => $conta->agencia,
        'conta' => $conta->conta,
        'estabelecimento' => $conta->estabelecimento->nome_fantasia ?? 'Sem Estabelecimento',
        'value' => "{$conta->banco} | Ag: {$conta->agencia} | Conta: {$conta->conta}",
      ];
    });

    return response()->json($results);
  }

  public function create()
  {
    $estabelecimentos = Estabelecimento::orderBy('nome_fantasia')->get();
    return view('contas.create', compact('estabelecimentos'));
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'banco' => 'required|string|max:100',
      'agencia' => 'nullable|string|max:50',
      'conta' => 'required|string|max:100',
      'tipo' => 'required|in:corrente,poupanca',
      'estabelecimento_id' => 'required|exists:estabelecimentos,id',
    ]);

    ContaBancaria::create($validated);

    return redirect()->route('contas.index')->with('success', 'Conta bancária criada com sucesso!');
  }

  public function edit(ContaBancaria $conta)
  {
    $estabelecimentos = Estabelecimento::orderBy('nome_fantasia')->get();
    return view('contas.edit', compact('conta', 'estabelecimentos'));
  }

  public function update(Request $request, ContaBancaria $conta)
  {
    $validated = $request->validate([
      'banco' => 'required|string|max:100',
      'agencia' => 'nullable|string|max:50',
      'conta' => 'required|string|max:100',
      'tipo' => 'required|in:corrente,poupanca',
      'estabelecimento_id' => 'required|exists:estabelecimentos,id',
    ]);

    $conta->update($validated);

    return redirect()->route('contas.index')->with('success', 'Conta bancária atualizada com sucesso!');
  }

  public function destroy(ContaBancaria $conta)
  {
    $conta->delete();
    return redirect()->route('contas.index')->with('success', 'Conta bancária excluída com sucesso!');
  }
  public function exportarCsv()
  {
    $ContaBancaria = \App\Models\ContaBancaria::all(['banco', 'agencia', 'conta', 'tipo', 'estabelecimento_id']);

    $csv = "banco;agencia;conta;tipo;";
    foreach ($ContaBancaria as $e) {
      $csv .= "{$e->banco};{$e->agencia};{$e->conta};{$e->tipo};\n";
    }

    $filename = 'ContaBancarias_' . now()->format('Ymd_His') . '.csv';

    return Response::make($csv, 200, [
      'Content-Type' => 'text/csv',
      'Content-Disposition' => "attachment; filename={$filename}",
    ]);
  }

}
