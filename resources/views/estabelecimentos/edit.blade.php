@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto bg-white p-8 rounded-xl shadow-2xl mt-10"> 
        <h2 class="text-3xl font-extrabold text-gray-800 mb-6 border-b pb-2">
            <i class="fas fa-building text-indigo-500 mr-2"></i> Editar Estabelecimento
        </h2>

        <form action="{{ route('estabelecimentos.update', $estabelecimento->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome Fantasia</label>
                <input type="text" name="nome_fantasia" value="{{ old('nome_fantasia', $estabelecimento->nome_fantasia) }}"
                    class="border border-gray-300 rounded-lg w-full p-3 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    required>
                @error('nome_fantasia')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Razão Social</label>
                <input type="text" name="razao_social" value="{{ old('razao_social', $estabelecimento->razao_social) }}"
                    class="border border-gray-300 rounded-lg w-full p-3 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    required>
                @error('razao_social')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">CNPJ</label>
                <input type="text" name="cnpj" value="{{ old('cnpj', $estabelecimento->cnpj) }}"
                    class="border border-gray-300 rounded-lg w-full p-3 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    required>
                @error('cnpj')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6"> 
                <label class="block text-sm font-medium text-gray-700 mb-1">Cliente</label>
                <select name="cliente_id"
                    class="border border-gray-300 rounded-lg w-full p-3 bg-white focus:ring-indigo-500 focus:border-indigo-500 transition duration-150"
                    required>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ $estabelecimento->cliente_id == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex space-x-2">
                <button type="submit"
                    class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-4 py-3 rounded-lg shadow-md transition duration-200">
                    <i class="fas fa-save mr-2"></i> Atualizar
                </button>
                <a href="{{ route('estabelecimentos.index') }}"
                    class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold px-4 py-3 rounded-lg shadow-md transition duration-200">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection