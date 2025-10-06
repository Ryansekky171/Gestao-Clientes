@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded-xl shadow-2xl mt-10">
    <h2 class="text-3xl font-extrabold text-gray-800 mb-6 border-b pb-2">
        <i class="fas fa-user-plus text-indigo-500 mr-2"></i> Cadastrar Novo Usuário
    </h2>

    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome Completo</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}"
                class="border border-gray-300 rounded-lg w-full p-3 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150" required>
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}"
                class="border border-gray-300 rounded-lg w-full p-3 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150" required>
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
            <input type="password" id="password" name="password"
                class="border border-gray-300 rounded-lg w-full p-3 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150" required>
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar Senha</label>
            <input type="password" id="password_confirmation" name="password_confirmation"
                class="border border-gray-300 rounded-lg w-full p-3 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150" required>
        </div>
        <div class="mb-6">
            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Usuário</label>
            <select id="type" name="type"
                class="border border-gray-300 rounded-lg w-full p-3 bg-white focus:ring-indigo-500 focus:border-indigo-500 transition duration-150" required>
                <option value="comum" {{ old('type') == 'comum' ? 'selected' : '' }}>Usuário Comum</option>
                <option value="admin" {{ old('type') == 'admin' ? 'selected' : '' }}>Administrador</option>
            </select>
            @error('type')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex space-x-3">
            <button type="submit"
                class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-4 py-3 rounded-lg shadow-md transition duration-200">
                <i class="fas fa-save mr-2"></i> Salvar Usuário
            </button>
            <a href="{{ route('usuarios.index') }}"
                class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold px-4 py-3 rounded-lg shadow-md transition duration-200">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection