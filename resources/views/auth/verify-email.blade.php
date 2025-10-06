<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar E-mail</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-50 text-gray-800">

    <div class="w-full max-w-3xl mx-auto flex bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="w-full md:w-1/2 p-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Verifique seu E-mail</h1>
            <p class="text-gray-600 mb-6">Um novo link de verificação foi enviado para o endereço de e-mail que você
                forneceu durante o registro.</p>

            <!-- Mensagem de status (se o link foi enviado recentemente) -->
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-3 rounded">
                    Um novo link de verificação foi enviado para o endereço de e-mail que você forneceu.
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}" class="space-y-4">
                @csrf
                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded-lg hover:bg-indigo-700 transition">
                    Reenviar E-mail de Verificação
                </button>
            </form>

            <div class="mt-6 text-center text-sm">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-600 font-semibold hover:underline">
                        Sair (Logout)
                    </button>
                </form>
            </div>
        </div>

        <div
            class="hidden md:flex md:w-1/2 items-center justify-center bg-gradient-to-tr from-slate-800 via-indigo-700 to-purple-700 p-8">
            <div class="text-center text-white px-6">
                <h2 class="text-4xl font-bold mb-2">Quase lá!</h2>
                <p class="text-lg opacity-90">Cheque sua caixa de entrada e clique no link para ativar sua conta.</p>
            </div>
        </div>
    </div>
</body>

</html>