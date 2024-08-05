<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAccess
{
  public function handle(Request $request, Closure $next, $accessId)
  {
    $user = Auth::user();

    if (
      !$user ||
      $user->acesso_id != $accessId ||
      !str_ends_with($user->email, $this->getDomainForAccessId($accessId))
    ) {
      abort(403, 'Unauthorized');
    }

    return $next($request);
  }

  private function getDomainForAccessId($accessId)
  {
    switch ($accessId) {
      case 1:
        return '@ifnmg';
      case 2:
        return '@ifnmg';
      case 3:
        return '@aluno.ifnmg';
      default:
        return '';
    }
  }
}
