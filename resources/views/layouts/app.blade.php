<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Gestão de Clientes') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        xintegrity="sha512-ie2d/3lKj8z7Vw9L20uJp7ZJp3aJp8H2P6iG1n3T95D2U/3N3t6F7o6O8z8Rz9S6Gg3J5j6l5A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">

    <nav class="bg-white shadow-md border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <h1 class="font-extrabold text-2xl text-indigo-600 tracking-wider">
                    <i class="fas fa-handshake mr-2"></i> Gestão de Clientes
                </h1>

                <div class="hidden md:flex space-x-2 items-center">
                    <a href="{{ route('dashboard') }}"
                        class="px-3 py-2 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-md font-medium transition duration-150">Dashboard</a>
                    <a href="{{ route('clientes.index') }}"
                        class="px-3 py-2 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-md font-medium transition duration-150">Clientes</a>
                    <a href="{{ route('estabelecimentos.index') }}"
                        class="px-3 py-2 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-md font-medium transition duration-150">Estabelecimentos</a>
                    <a href="{{ route('contas.index') }}"
                        class="px-3 py-2 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-md font-medium transition duration-150">Contas
                        Bancárias</a>

                    @if(auth()->check() && auth()->user()->type === 'admin')
                        <a href="{{ route('usuarios.index') }}"
                            class="px-3 py-2 text-gray-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-md font-medium transition duration-150">Usuários</a>
                    @endif

                    <div class="relative ml-4" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center px-4 py-2 bg-indigo-500 text-white rounded-lg shadow-md hover:bg-indigo-600 transition">
                            <i class="fas fa-user-circle mr-2"></i> {{ auth()->user()->name }}
                            <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-100 z-50 origin-top-right transform scale-95"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 rounded-md font-medium">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Sair
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="md:hidden">
                    <button id="mobile-menu-button" class="focus:outline-none text-gray-700 hover:text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-200 py-2">
            <a href="{{ route('dashboard') }}"
                class="block px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition font-medium">Dashboard</a>
            <a href="{{ route('clientes.index') }}"
                class="block px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition font-medium">Clientes</a>
            <a href="{{ route('estabelecimentos.index') }}"
                class="block px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition font-medium">Estabelecimentos</a>
            <a href="{{ route('contas.index') }}"
                class="block px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition font-medium">Contas
                Bancárias</a>

            @if(auth()->check() && auth()->user()->type === 'admin')
                <a href="{{ route('usuarios.index') }}"
                    class="block px-4 py-3 text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 transition font-medium">Usuários</a>
            @endif

            <form method="POST" action="{{ route('logout') }}" class="pt-4 border-t border-gray-100 mt-2">
                @csrf
                <button type="submit"
                    class="w-full text-left px-4 py-3 text-white bg-red-500 hover:bg-red-600 transition font-medium">
                    <i class="fas fa-sign-out-alt mr-2"></i> Sair
                </button>
            </form>
        </div>
    </nav>

    <main class="flex-grow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full">

        @if (session('status'))
            <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-100 border border-red-300 shadow-sm" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (session('success'))
            <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-100 border border-green-300 shadow-sm"
                role="alert">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        const button = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        button.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>

</body>

</html>