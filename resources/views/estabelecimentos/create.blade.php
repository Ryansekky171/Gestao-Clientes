@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto bg-white p-6 rounded-xl shadow">
        <h2 class="text-2xl font-bold mb-4">Cadastrar Estabelecimento</h2>

        <form action="{{ route('estabelecimentos.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block font-medium">Nome Fantasia</label>
                <input type="text" name="nome_fantasia" value="{{ old('nome_fantasia') }}" class="border rounded w-full p-2"
                    required>
                @error('nome_fantasia')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium">Razão Social</label>
                <input type="text" name="razao_social" value="{{ old('razao_social') }}" class="border rounded w-full p-2"
                    required>
                @error('razao_social')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium">CNPJ</label>
                <input type="text" name="cnpj" value="{{ old('cnpj') }}" class="border rounded w-full p-2" required>
                @error('cnpj')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block font-medium">Cliente</label>
                <select name="cliente_id" class="border rounded w-full p-2" required>
                    <option value="">Selecione um cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nome }}
                        </option>
                    @endforeach
                </select>
                @error('cliente_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-2">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow transition">
                    Salvar
                </button>
                <a href="{{ route('estabelecimentos.index') }}"
                    class="bg-gray-400 hover:bg-gray-500 text-black px-4 py-2 rounded-lg shadow transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection