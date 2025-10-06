@extends('layouts.app')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-3xl font-bold text-indigo-700">Usuários</h2>
    </div>
    <div class="mb-6 flex justify-between items-center">
        <form method="GET" action="{{ route('usuarios.index') }}" class="flex items-center space-x-2">
            <div class="relative">
                <input type="text" name="term" value="{{ $term }}" placeholder="Buscar por Nome ou E-mail..."
                    class="border border-gray-300 rounded-lg pl-10 pr-4 py-2 w-72 focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 shadow-sm">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
            <button type="submit"
                class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium px-4 py-2 rounded-lg shadow-md transition duration-200 flex items-center">
                <i class="fas fa-filter mr-2"></i> Filtrar
            </button>
        </form>
    </div>
    <div class="bg-white shadow-xl rounded-xl overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-indigo-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Nome</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">E-mail
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Tipo</th>

                    <!-- COLUNA AÇÕES SÓ PARA ADMIN -->
                    @if(auth()->check() && auth()->user()->type === 'admin')
                        <th class="px-6 py-3 text-center text-xs font-semibold text-indigo-700 uppercase tracking-wider">Ações
                        </th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($users as $user)
                    <tr class="hover:bg-indigo-50/50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm capitalize">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $user->type === 'admin' ? 'bg-indigo-100 text-indigo-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $user->type }}
                            </span>
                        </td>
                        @if(auth()->check() && auth()->user()->type === 'admin')
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                <div class="flex items-center justify-center space-x-3">
                                    <a href="{{ route('usuarios.edit', $user) }}"
                                        class="text-indigo-600 hover:text-indigo-900 transition duration-150 transform hover:scale-110"
                                        title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('usuarios.destroy', $user) }}" method="POST" class="inline"
                                        onsubmit="return confirm('ATENÇÃO: Você tem certeza que deseja excluir o usuário {{ $user->name }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-900 transition duration-150 transform hover:scale-110"
                                            title="Excluir">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-6 flex justify-end space-x-3">

        @if(auth()->check() && auth()->user()->type === 'admin')
            <a href="{{ route('usuarios.create') }}"
                class="bg-indigo-500 text-white font-bold px-4 py-2 rounded-lg shadow-md hover:bg-indigo-600 transition duration-200 transform hover:scale-[1.02] flex items-center">
                <i class="fas fa-plus mr-2"></i> Criar Novo Usuário
            </a>
            <a href="{{ route('usuarios.exportar') }}"
                class="bg-green-500 text-white font-bold px-4 py-2 rounded-lg shadow-md hover:bg-green-600 transition duration-200 transform hover:scale-[1.02] flex items-center">
                <i class="fas fa-file-csv mr-2"></i> Exportar CSV
            </a>
        @endif
        <a href="{{ route('usuarios.index') }}"
            class="bg-gray-300 text-gray-800 font-medium px-4 py-2 rounded-lg shadow-md hover:bg-gray-400 transition duration-200 flex items-center">
            <i class="fas fa-sync-alt mr-2"></i> Remover Filtro
        </a>
    </div>

@endsection