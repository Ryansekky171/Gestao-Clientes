@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-2xl border border-gray-200">
    <h2 class="text-3xl font-extrabold text-gray-800 mb-6 border-b pb-2">Cadastrar Novo Cliente</h2>

    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="col-span-1">
                <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome Completo</label>
                <input type="text" name="nome" id="nome" value="{{ old('nome') }}"
                    class="border border-gray-300 rounded-lg w-full p-3 focus:ring-blue-500 focus:border-blue-500" required>
                @error('nome')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-span-1">
                <label for="cpf_cnpj" class="block text-sm font-medium text-gray-700 mb-1">CPF ou CNPJ</label>
                <input type="text" name="cpf_cnpj" id="cpf_cnpj" value="{{ old('cpf_cnpj') }}"
                    class="border border-gray-300 rounded-lg w-full p-3 focus:ring-blue-500 focus:border-blue-500" required>
                @error('cpf_cnpj')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-1">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    class="border border-gray-300 rounded-lg w-full p-3 focus:ring-blue-500 focus:border-blue-500">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-1">
                <label for="telefone" class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                <input type="text" name="telefone" id="telefone" value="{{ old('telefone') }}"
                    class="border border-gray-300 rounded-lg w-full p-3 focus:ring-blue-500 focus:border-blue-500">
                @error('telefone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <div class="mt-6">
            <label for="endereco" class="block text-sm font-medium text-gray-700 mb-1">Endereço Completo</label>
            <textarea name="endereco" id="endereco" rows="2"
                class="border border-gray-300 rounded-lg w-full p-3 focus:ring-blue-500 focus:border-blue-500">{{ old('endereco') }}</textarea>
            @error('endereco')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-3 mt-8">
            <a href="{{ route('clientes.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold px-6 py-3 rounded-lg shadow-md transition duration-150 ease-in-out">
                Cancelar
            </a>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-150 ease-in-out transform hover:scale-105">
                <i class="fas fa-save mr-2"></i> Salvar Cliente
            </button>
        </div>
    </form>
</div>
@endsection
