<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Senha</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-50 text-gray-800">

    <div class="w-full max-w-3xl mx-auto flex bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="w-full md:w-1/2 p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Confirmação de Senha</h1>
            <p class="text-gray-600 mb-6">Por favor, confirme sua senha antes de continuar.</p>

            @if ($errors->any())
                <div class="bg-red-50 text-red-700 px-4 py-3 rounded mb-4 border border-red-100">
                    <ul class="list-disc ml-5 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="mt-1 w-full px-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none bg-gray-50">
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                    Confirmar
                </button>
            </form>
            <div class="mt-6 text-center text-sm">
                <p class="text-gray-600">
                    <a href="{{ route('password.request') }}" class="text-indigo-600 font-semibold hover:underline">
                        Esqueceu sua senha?
                    </a>
                </p>
            </div>
        </div>

        <div
            class="hidden md:flex md:w-1/2 items-center justify-center bg-gradient-to-tr from-slate-800 via-indigo-700 to-purple-700 p-8">
            <div class="text-center text-white px-6">
                <h2 class="text-4xl font-bold mb-2">Segurança</h2>
                <p class="text-lg opacity-90">Sua segurança é importante. Confirme sua identidade para acessar as
                    configurações.</p>
            </div>
             
        </div>
    </div>
</body>

</html>