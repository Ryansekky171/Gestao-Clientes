@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-xl shadow">
    <h2 class="text-2xl font-bold mb-4">Editar Conta Bancária</h2>

    <form action="{{ route('contas.update', $conta->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-medium">Banco</label>
            <input type="text" name="banco" value="{{ old('banco', $conta->banco) }}" class="w-full border rounded px-3 py-2" required>
            @error('banco') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium">Agência</label>
            <input type="text" name="agencia" value="{{ old('agencia', $conta->agencia) }}" class="w-full border rounded px-3 py-2">
            @error('agencia') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium">Conta</label>
            <input type="text" name="conta" value="{{ old('conta', $conta->conta) }}" class="w-full border rounded px-3 py-2" required>
            @error('conta') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium">Tipo</label>
            <select name="tipo" class="w-full border rounded px-3 py-2" required>
                <option value="corrente" {{ old('tipo', $conta->tipo) == 'corrente' ? 'selected' : '' }}>Corrente</option>
                <option value="poupanca" {{ old('tipo', $conta->tipo) == 'poupanca' ? 'selected' : '' }}>Poupança</option>
            </select>
            @error('tipo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block font-medium">Estabelecimento</label>
            <select name="estabelecimento_id" class="w-full border rounded px-3 py-2" required>
                <option value="">Selecione</option>
                @foreach($estabelecimentos as $est)
                    <option value="{{ $est->id }}" {{ (old('estabelecimento_id', $conta->estabelecimento_id) == $est->id) ? 'selected' : '' }}>
                        {{ $est->nome_fantasia }} — {{ $est->razao_social }}
                    </option>
                @endforeach
            </select>
            @error('estabelecimento_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('contas.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Cancelar</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Atualizar</button>
        </div>
    </form>
</div>
@endsection
