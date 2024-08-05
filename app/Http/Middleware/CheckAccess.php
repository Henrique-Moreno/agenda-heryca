<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAccess
{
    public function handle(Request $request, Closure $next, $domain)
    {
        $user = Auth::user();

        // Adicionando mensagens de depuração
        if (!$user) {
            dd('Usuário não autenticado.');
        }

        if (!str_ends_with($user->email, $domain)) {
            dd('E-mail do usuário não termina com o domínio esperado: ' . $user->email);
        }

        return $next($request);
    }
}
