@extends('layouts.app')

@section('content')
<div class="py-8">
    <h2 class="text-4xl font-extrabold text-center text-gray-800 mb-10">Painel de Controle</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

        <a href="{{ route('clientes.index') }}" class="block">
            <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 text-white rounded-2xl p-6 shadow-xl transition duration-300 transform hover:scale-[1.03] hover:shadow-2xl">
                <div class="text-center">
                    <div class="flex justify-center mb-4">
                        <i class="fas fa-users text-4xl"></i>
                    </div>
                    <h5 class="text-lg font-semibold uppercase opacity-90">Clientes</h5>
                    <p class="text-5xl font-extrabold mt-2 tracking-wide">{{ $totalClientes }}</p>
                </div>
            </div>
        </a>

        <a href="{{ route('estabelecimentos.index') }}" class="block">
            <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-2xl p-6 shadow-xl transition duration-300 transform hover:scale-[1.03] hover:shadow-2xl">
                <div class="text-center">
                    <div class="flex justify-center mb-4">
                        <i class="fas fa-store-alt text-4xl"></i>
                    </div>
                    <h5 class="text-lg font-semibold uppercase opacity-90">Estabelecimentos</h5>
                    <p class="text-5xl font-extrabold mt-2 tracking-wide">{{ $totalEstabelecimentos }}</p>
                </div>
            </div>
        </a>

        <a href="{{ route('contas.index') }}" class="block">
            <div class="bg-gradient-to-br from-sky-500 to-sky-600 text-white rounded-2xl p-6 shadow-xl transition duration-300 transform hover:scale-[1.03] hover:shadow-2xl">
                <div class="text-center">
                    <div class="flex justify-center mb-4">
                        <i class="fas fa-wallet text-4xl"></i>
                    </div>
                    <h5 class="text-lg font-semibold uppercase opacity-90">Contas Bancárias</h5>
                    <p class="text-5xl font-extrabold mt-2 tracking-wide">{{ $totalContas }}</p>
                </div>
            </div>
        </a>

                <div class="bg-gradient-to-br from-red-500 to-red-600 text-white rounded-2xl p-6 shadow-xl transition duration-300 transform hover:scale-[1.03] hover:shadow-2xl">
                    <div class="text-center">
                        <div class="flex justify-center mb-4">
                            <i class="fas fa-user-friends text-4xl"></i>
                        </div>
                        <h5 class="text-lg font-semibold uppercase opacity-90">Usuários</h5>
                        <p class="text-5xl font-extrabold mt-2 tracking-wide">{{ $totalUsuarios }}</p>
                    </div>
                </div>


    </div>
</div>
@endsection
