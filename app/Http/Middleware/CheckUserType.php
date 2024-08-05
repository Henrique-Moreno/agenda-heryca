<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $type
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $type)
    {
        $user = Auth::user();

        if ($user) {
            // Verifica o tipo de usuário e o acesso_id
            switch ($type) {
                case 'aluno':
                    if (strpos($user->email, '@aluno.ifnmg') === false || $user->acesso_id !== 3) {
                        abort(403, 'Acesso negado');
                    }
                    break;
                case 'servidor':
                    if (strpos($user->email, '@ifnmg') === false || $user->acesso_id !== 2) {
                        abort(403, 'Acesso negado');
                    }
                    break;
                case 'admin':
                    if (strpos($user->email, '@ifnmg') === false || $user->acesso_id !== 1) {
                        abort(403, 'Acesso negado');
                    }
                    break;
                default:
                    abort(403, 'Acesso negado');
            }
        } else {
            abort(403, 'Usuário não autenticado');
        }

        return $next($request);
    }
}
