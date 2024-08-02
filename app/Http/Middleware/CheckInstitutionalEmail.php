<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckInstitutionalEmail
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next)
  {
    // Verifica se o usuário está autenticado
    if (Auth::check()) {
      $user = Auth::user();
      $email = $user->email;
      $emailDomain = explode('@', $email)[1];

      // Verifica se o domínio do e-mail é o esperado
      if (str_ends_with($email, '@aluno.ifnmg.edu.br')) {
        // Permitir acesso se o e-mail é de aluno
        return $next($request);
      } elseif (str_ends_with($email, '@ifnmg.edu.br')) {
        // Permitir acesso se o e-mail é de servidor
        return $next($request);
      } else {
        // Fazer logout e redirecionar se o e-mail não for válido
        Auth::logout();
        return redirect('/login')->withErrors([
          'email' => 'Você deve usar um e-mail institucional válido para acessar o sistema.',
        ]);
      }
    }

    return $next($request);
  }
}
