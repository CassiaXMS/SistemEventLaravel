<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // if (!Auth::check() || Auth::user()->email !== 'admin@example.com') {
        //     abort(403, 'Acesso negado.');
        // }
        // if (!Auth::check() || Auth::user()->email !== 'admin@example.com') {
        //     abort(403, 'Acesso negado.');
        // }

        // if (!Auth::check() || !Auth::user()->is_admin) {
        //     // Redireciona para a página inicial ou outra página desejada se o usuário não for admin
        //     return redirect('filament.auth.login')->with('error', 'Você não tem permissão para acessar esta página.');
        // }

        return $next($request);
    }
}
