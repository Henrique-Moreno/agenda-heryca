<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function Authenticate(Request $request)
    {
        // Validação das credenciais fornecidas
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tenta autenticar com as credenciais fornecidas
        if (Auth::attempt($credentials)) {
            // Obtém o usuário autenticado
            $user = Auth::user();

            // Verifica o domínio do email e o acesso_id
            if ($this->isValidUser($user)) {
                $request->session()->regenerate();
                return redirect()->route('pages-page-2');
            }

            // Se o usuário não é válido, desloga e retorna com erro
            Auth::logout();
            return back()->withErrors([
                'email' => 'Você não tem permissão para acessar.',
            ])->onlyInput('email');
        }

        // Retorna com erro se as credenciais não são válidas
        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email');
    }

    // Método para verificar se o usuário tem permissão
    protected function isValidUser($user)
    {
        // Define os domínios e acesso_id permitidos
        $validDomains = [
            '@aluno.ifnmg' => 3,
            '@ifnmg' => 2,
        ];

        // Verifica se o email contém um dos domínios e se o acesso_id é o correto
        foreach ($validDomains as $domain => $acesso_id) {
            if (str_ends_with($user->email, $domain) && $user->acesso_id == $acesso_id) {
                return true;
            }
        }

        return false;
    }
}
