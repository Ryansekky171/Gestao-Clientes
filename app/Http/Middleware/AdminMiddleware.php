<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next)
    {
        // 1. Verifica se o usuário está logado
        // 2. Se estiver logado, verifica se o campo 'type' do usuário é 'admin'
        if (!Auth::check() || Auth::user()->type !== 'admin') {
            // Se não for admin, redireciona para a página inicial com uma mensagem de erro na sessão.
            return redirect('/')->with('error', 'Acesso negado. Você não tem permissão de administrador para esta área.');
        }

        return $next($request);
    }
}
