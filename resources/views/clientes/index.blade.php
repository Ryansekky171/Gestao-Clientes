@extends('layouts.app')

@section('content')

<div class="mb-6 flex justify-between items-center">
    <h2 class="text-3xl font-bold text-indigo-700">Clientes</h2>
</div>

@if($clientes->isEmpty())
    <div class="bg-white shadow-xl rounded-xl p-8 text-center">
        <p class="text-gray-500 text-lg">Nenhum cliente cadastrado.</p>
    </div>
@else
    <div class="mb-6">
        <div class="relative flex-grow max-w-lg">
            <input type="text" id="search-name" 
                placeholder="Buscar por Nome (mínimo 3 caracteres)"
                class="border border-gray-300 rounded-lg pl-10 pr-4 py-2 w-full focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 shadow-sm"
                value="{{ request('nome') }}">
            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            
            <ul id="autocomplete-results"
                class="absolute z-10 bg-white border border-gray-200 rounded-lg w-full mt-1 hidden shadow-lg max-h-60 overflow-y-auto">
            </ul>
        </div>
    </div>
    
    <div class="bg-white shadow-xl rounded-xl overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-indigo-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Nome</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Telefone</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">CPF/CNPJ</th>
                    
                    @if(auth()->check() && auth()->user()->type === 'admin')
                        <th class="px-6 py-3 text-center text-xs font-semibold text-indigo-700 uppercase tracking-wider">Ações</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($clientes as $cliente)
                    <tr class="hover:bg-indigo-50/50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $cliente->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $cliente->nome }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $cliente->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $cliente->telefone }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $cliente->cpf_cnpj }}</td>
                        
                        @if(auth()->check() && auth()->user()->type === 'admin')
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                <div class="flex items-center justify-center space-x-3">
                                    <a href="{{ route('clientes.edit', $cliente->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 transition duration-150 transform hover:scale-110" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('ATENÇÃO: Você tem certeza que deseja excluir o cliente {{ $cliente->nome }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-900 transition duration-150 transform hover:scale-110" title="Excluir">
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

        <div class="p-4">
            {{ $clientes->links() }}
        </div>
    </div>
    
    <div class="mt-6 flex justify-end space-x-3">
        @if(auth()->check() && auth()->user()->type === 'admin')
            <a href="{{ route('clientes.create') }}"
                class="bg-indigo-500 text-white font-bold px-4 py-2 rounded-lg shadow-md hover:bg-indigo-600 transition duration-200 transform hover:scale-[1.02] flex items-center">
                <i class="fas fa-user-plus mr-2"></i> Criar Novo Cliente
            </a>
        @endif

        @if(request('nome'))
            <a href="{{ route('clientes.index') }}"
                class="bg-gray-300 text-gray-800 font-medium px-4 py-2 rounded-lg shadow-md hover:bg-gray-400 transition duration-200 flex items-center">
                <i class="fas fa-times-circle mr-2"></i> Remover Filtro
            </a>
        @endif
    </div>
@endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        const searchInput = $('#search-name');
        const resultsContainer = $('#autocomplete-results');

        $(document).on('click', function (e) {
            if (!$(e.target).closest('#search-name, #autocomplete-results').length) {
                resultsContainer.addClass('hidden').empty();
            }
        });

        searchInput.on('keyup', function () {
            const query = $(this).val();

            if (query.length < 3) {
                resultsContainer.addClass('hidden').empty();
                return;
            }
            $.ajax({
                url: "/clientes/search",
                method: 'GET',
                data: { term: query },
                success: function (data) {
                    resultsContainer.empty();

                    if (data.length > 0) {
                        $.each(data, function (index, name) {
                            const listItem = $(`<li class="p-3 cursor-pointer hover:bg-indigo-100 transition border-b last:border-b-0" data-name="${name}">
                                <div class="font-medium text-gray-800">${name}</div>
                            </li>`);
                            resultsContainer.append(listItem);
                        });
                        resultsContainer.removeClass('hidden');
                    } else {
                        resultsContainer.html('<li class="p-3 text-gray-500">Nenhum cliente encontrado.</li>').removeClass('hidden');
                    }
                }
            });
        });
        
        resultsContainer.on('click', 'li', function () {
            const selectedName = $(this).data('name');
            window.location.href = `{{ route('clientes.index') }}?nome=${encodeURIComponent(selectedName)}`;
        });
    });
</script>
@endsection
