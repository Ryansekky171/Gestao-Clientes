@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">
        <h2 class="text-2xl font-bold mb-4">Editar Usuário</h2>

        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block font-medium text-gray-700">Nome</label>
                <input type="text" name="name" id="name" value="{{ old('name', $usuario->name) }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                @error('name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $usuario->email) }}"
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                @error('email')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block font-medium text-gray-700">Nova Senha (opcional)</label>
                <input type="password" name="password" id="password"
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2">
                @error('password')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="block font-medium text-gray-700">Confirme a Nova Senha</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2">
            </div>

            <div class="mb-4">
                <label for="type" class="block font-medium text-gray-700">Tipo de Usuário</label>
                <select name="type" id="type" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    <option value="admin" {{ old('type', $usuario->type) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="comum" {{ old('type', $usuario->type) == 'comum' ? 'selected' : '' }}>Comum</option>
                </select>
                @error('type')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex space-x-2">
                <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow hover:bg-indigo-500 transition transform hover:-translate-y-0.5 hover:scale-105">
                    Atualizar Usuário
                </button>
                <a href="{{ route('usuarios.index') }}"
                    class="bg-gray-400 text-white px-4 py-2 rounded-lg shadow hover:bg-gray-300 transition transform hover:-translate-y-0.5 hover:scale-105">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection