    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\ClienteController;
    use App\Http\Controllers\EstabelecimentoController;
    use App\Http\Controllers\ContaBancariaController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\DashboardController;
    // admin apenas
    Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('usuarios', UserController::class);
    });
    // Redireciona home
    Route::get('/', function () {
    return redirect()->route('dashboard');
    });
    Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

    // Rotas protegidas
    Route::middleware(['auth'])->group(function () {
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/search', [ClienteController::class, 'search'])->name('clientes.search');
    
    Route::get('/clientes/create', [ClienteController::class, 'create'])->name('clientes.create');
    Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/{cliente}/edit', [ClienteController::class, 'edit'])->name('clientes.edit');
    Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');

    // Estabelecimentos
    Route::get('/estabelecimentos', [EstabelecimentoController::class, 'index'])->name('estabelecimentos.index');
    Route::get('/estabelecimentos/create', [EstabelecimentoController::class, 'create'])->name('estabelecimentos.create');
    Route::post('/estabelecimentos', [EstabelecimentoController::class, 'store'])->name('estabelecimentos.store');
    Route::get('/estabelecimentos/{estabelecimento}/edit', [EstabelecimentoController::class, 'edit'])->name('estabelecimentos.edit');
    Route::put('/estabelecimentos/{estabelecimento}', [EstabelecimentoController::class, 'update'])->name('estabelecimentos.update');
    Route::delete('/estabelecimentos/{estabelecimento}', [EstabelecimentoController::class, 'destroy'])->name('estabelecimentos.destroy');
    Route::get('/estabelecimentos/search', [EstabelecimentoController::class, 'search'])
    ->name('estabelecimentos.search');
    
    // Contas
    Route::get('/contas', [ContaBancariaController::class, 'index'])->name('contas.index');
    Route::get('/contas/create', [ContaBancariaController::class, 'create'])->name('contas.create');
    Route::post('/contas', [ContaBancariaController::class, 'store'])->name('contas.store');
    Route::get('/contas/{conta}/edit', [ContaBancariaController::class, 'edit'])->name('contas.edit');
    Route::put('/contas/{conta}', [ContaBancariaController::class, 'update'])->name('contas.update');
    Route::delete('/contas/{conta}', [ContaBancariaController::class, 'destroy'])->name('contas.destroy');
    // Rota do meu autocomplete
    Route::get('/contas/autocomplete', [ContaBancariaController::class, 'autocomplete'])->name('contas.autocomplete');

    });
    require __DIR__.'/auth.php';
