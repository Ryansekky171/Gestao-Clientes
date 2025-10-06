@extends('layouts.app')

@section('content')

<div class="mb-6 flex justify-between items-center">
    <h2 class="text-3xl font-bold text-indigo-700">Estabelecimentos</h2>
</div>

@if($estabelecimentos->isEmpty())
    <div class="bg-white shadow-xl rounded-xl p-8 text-center">
        <p class="text-gray-500 text-lg">Nenhum estabelecimento cadastrado.</p>
    </div>
@else
    <div class="mb-6">
        <div class="relative flex-grow max-w-lg">
            <input type="text" id="search-name" 
                placeholder="Buscar por Nome Fantasia ou CNPJ (mínimo 3 caracteres)"
                class="border border-gray-300 rounded-lg pl-10 pr-4 py-2 w-full focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 shadow-sm"
                value="{{ request('search') }}">
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
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Nome Fantasia</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Razão Social</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">CNPJ</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Cliente</th>
                    
                    @if(auth()->check() && auth()->user()->type === 'admin')
                        <th class="px-6 py-3 text-center text-xs font-semibold text-indigo-700 uppercase tracking-wider">Ações</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($estabelecimentos as $estabelecimento)
                    <tr class="hover:bg-indigo-50/50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $estabelecimento->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $estabelecimento->nome_fantasia }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $estabelecimento->razao_social }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $estabelecimento->cnpj }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $estabelecimento->cliente->nome ?? '—' }}
                        </td>
                        
                        @if(auth()->check() && auth()->user()->type === 'admin')
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                <div class="flex items-center justify-center space-x-3">
                                    <a href="{{ route('estabelecimentos.edit', $estabelecimento->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 transition duration-150 transform hover:scale-110" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('estabelecimentos.destroy', $estabelecimento->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('ATENÇÃO: Você tem certeza que deseja excluir o estabelecimento {{ $estabelecimento->nome_fantasia }}?');">
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
            {{ $estabelecimentos->links() }}
        </div>
    </div>
    
    <div class="mt-6 flex justify-end space-x-3">
        @if(auth()->check() && auth()->user()->type === 'admin')
            <a href="{{ route('estabelecimentos.create') }}"
                class="bg-indigo-500 text-white font-bold px-4 py-2 rounded-lg shadow-md hover:bg-indigo-600 transition duration-200 transform hover:scale-[1.02] flex items-center">
                <i class="fas fa-building mr-2"></i> Criar Novo Estabelecimento
            </a>
        @endif

        @if(request('search'))
            <a href="{{ route('estabelecimentos.index') }}"
                class="bg-gray-300 text-gray-800 font-medium px-4 py-2 rounded-lg shadow-md hover:bg-gray-400 transition duration-200 flex items-center">
                <i class="fas fa-times-circle mr-2"></i> Remover Filtro
            </a>
        @endif
    </div>
@endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('search-name');
        const resultsBox = document.getElementById('autocomplete-results');
        const baseUrl = '{{ route('estabelecimentos.search') }}';

        function hideResults() {
            resultsBox.innerHTML = '';
            resultsBox.classList.add('hidden');
        }

        input.addEventListener('input', function () {
            const term = this.value.trim();

            if (term.length < 3) {
                hideResults();
                return;
            }

            fetch(`${baseUrl}?term=${encodeURIComponent(term)}`)
                .then(res => res.json())
                .then(data => {
                    resultsBox.innerHTML = '';

                    if (data.length > 0) {
                        data.forEach(item => {
                            const li = document.createElement('li');
                            li.innerHTML = `<div class="font-medium text-gray-800">${item.nome_fantasia}</div><div class="text-sm text-gray-500">${item.cnpj}</div>`;
                            li.classList.add('p-3', 'cursor-pointer', 'hover:bg-indigo-100', 'transition', 'border-b', 'last:border-b-0');
                            li.addEventListener('click', () => {
                                // Redireciona para a URL de filtro usando 'search' como o query param
                                window.location.href = `{{ route('estabelecimentos.index') }}?search=${encodeURIComponent(item.nome_fantasia)}`;
                            });
                            resultsBox.appendChild(li);
                        });
                        resultsBox.classList.remove('hidden');
                    } else {
                         resultsBox.innerHTML = '<li class="p-3 text-gray-500">Nenhum estabelecimento encontrado.</li>';
                         resultsBox.classList.remove('hidden');
                    }
                })
                .catch(err => {
                    console.error('Erro ao buscar autocomplete:', err);
                    hideResults();
                });
        });

        document.addEventListener('click', function (e) {
            if (!resultsBox.contains(e.target) && e.target !== input) {
                hideResults();
            }
        });
    });
</script>
@endsection
