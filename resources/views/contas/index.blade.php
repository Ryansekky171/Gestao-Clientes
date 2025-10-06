@extends('layouts.app')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-3xl font-bold text-indigo-700">Contas Bancarias</h2>
    </div>
    <div class="mb-6 flex justify-between items-center">
        <form method="GET" action="{{ route('contas.index') }}" id="search-form"
            class="flex-grow flex items-center space-x-2">
            <div class="relative flex-grow">
                <input type="text" id="search-contas" name="term"
                    placeholder="Buscar por Banco, Agência ou Conta (mínimo 3 caracteres)"
                    class="border border-gray-300 rounded-lg pl-10 pr-4 py-2 w-full max-w-lg focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 shadow-sm"
                    value="{{ request('term') }}">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>

                <ul id="autocomplete-results"
                    class="absolute z-10 bg-white border border-gray-200 rounded-lg w-full max-w-lg mt-1 hidden shadow-lg max-h-60 overflow-y-auto">
                </ul>
            </div>

            @if(request('term'))
                <a href="{{ route('contas.index') }}"
                    class="bg-gray-300 text-gray-800 font-medium px-4 py-2 rounded-lg shadow-md hover:bg-gray-400 transition duration-200 flex items-center">
                    <i class="fas fa-times-circle mr-2"></i> Remover Filtro
                </a>
            @endif
        </form>
    </div>

    <div class="bg-white shadow-xl rounded-xl overflow-hidden">
        @if($contas->isEmpty())
            <div class="p-8 text-center">
                <p class="text-gray-500 text-lg">Nenhuma conta bancária encontrada com o termo de busca atual.</p>
            </div>
        @else
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-indigo-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Banco
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Agência
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Conta
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">Tipo</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-indigo-700 uppercase tracking-wider">
                            Estabelecimento</th>

                        @if(auth()->check() && auth()->user()->type === 'admin')
                            <th class="px-6 py-3 text-center text-xs font-semibold text-indigo-700 uppercase tracking-wider">Ações
                            </th>
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($contas as $c)
                        <tr class="hover:bg-indigo-50/50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $c->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $c->banco }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $c->agencia }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $c->conta }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm capitalize">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                                    {{ $c->tipo === 'corrente' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $c->tipo }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $c->estabelecimento->nome_fantasia ?? '—' }}
                            </td>

                            @if(auth()->check() && auth()->user()->type === 'admin')
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    <div class="flex items-center justify-center space-x-3">
                                        <a href="{{ route('contas.edit', $c->id) }}"
                                            class="text-indigo-600 hover:text-indigo-900 transition duration-150 transform hover:scale-110"
                                            title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('contas.destroy', $c->id) }}" method="POST" class="inline"
                                            onsubmit="return confirm('ATENÇÃO: Você tem certeza que deseja excluir esta conta bancária (Banco: {{ $c->banco }}, Conta: {{ $c->conta }})?');">
                                            @csrf
                                            @method('DELETE')
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

            <div class="p-4">
                {{ $contas->links() }}
            </div>
        @endif
    </div>

    <div class="mt-6 flex justify-end space-x-3">
        @if(auth()->check() && auth()->user()->type === 'admin')
            <a href="{{ route('contas.create') }}"
                class="bg-indigo-500 text-white font-bold px-4 py-2 rounded-lg shadow-md hover:bg-indigo-600 transition duration-200 transform hover:scale-[1.02] flex items-center">
                <i class="fas fa-plus mr-2"></i> Adicionar Nova Conta
            </a>
        @endif

        @if(!request('term'))
            <a href="{{ route('contas.index') }}"
                class="bg-gray-300 text-gray-800 font-medium px-4 py-2 rounded-lg shadow-md hover:bg-gray-400 transition duration-200 flex items-center">
                <i class="fas fa-sync-alt mr-2"></i> Limpar Busca
            </a>
            <a href="{{ route('contas.exportar') }}"
                class="bg-green-500 text-white font-bold px-4 py-2 rounded-lg shadow-md hover:bg-green-600 transition duration-200 transform hover:scale-[1.02] flex items-center">
                <i class="fas fa-file-csv mr-2"></i> Exportar CSV
            </a>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            const searchInput = $('#search-contas');
            const resultsContainer = $('#autocomplete-results');
            const form = $('#search-form');

            $(document).on('click', function (e) {
                if (!$(e.target).closest('#search-contas, #autocomplete-results').length) {
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
                    url: "{{ route('contas.autocomplete') }}",
                    method: 'GET',
                    data: { term: query },
                    success: function (data) {
                        resultsContainer.empty();

                        if (data.length > 0) {
                            $.each(data, function (index, conta) {
                                const fullTerm = `${conta.banco} | Ag: ${conta.agencia} | Conta: ${conta.conta}`;

                                const listItem = $(`<li class="p-3 cursor-pointer hover:bg-indigo-100 transition border-b last:border-b-0" data-term="${fullTerm}">
                                            <div class="font-medium text-gray-800">${fullTerm}</div>
                                            <div class="text-sm text-gray-500">Estabelecimento: ${conta.estabelecimento}</div>
                                        </li>`);
                                resultsContainer.append(listItem);
                            });
                            resultsContainer.removeClass('hidden');
                        } else {
                            resultsContainer.html('<li class="p-3 text-gray-500">Nenhum resultado encontrado.</li>').removeClass('hidden');
                        }
                    }
                });
            });

            resultsContainer.on('click', 'li', function () {
                const selectedTerm = $(this).data('term');
                searchInput.val(selectedTerm);
                form.submit();
                resultsContainer.addClass('hidden').empty();
            });

        });
    </script>
@endsection