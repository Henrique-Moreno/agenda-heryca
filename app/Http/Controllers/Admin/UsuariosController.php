<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipoUsuario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
  /**
   * Exibe uma lista dos recursos.
   */
  public function index()
  {
    $tipoAcesso = TipoUsuario::all();
    $usuarios = User::all();
    return view('admin.usuarios.index')
      ->with('tipos', $tipoAcesso)
      ->with('usuarios', $usuarios);
  }

  /**
   * Mostra o formulário para criar um novo recurso.
   */
  public function create()
  {
    $tiposAcesso = TipoUsuario::all();
    return view('admin.usuarios.create', compact('tiposAcesso'));
  }

  /**
   * Armazena um recurso recém-criado no armazenamento.
   */
  public function store(Request $request)
  {
    try {
      // Validação do request
      $request->validate([
        'acesso_id' => 'required|exists:tipo_usuarios,id',
        'name' => 'required|string|max:255',
        'nome_completo' => 'required|string|max:255',
        'cpf' => 'required|string|max:14|unique:users,CPF',
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => 'required|string|min:8|confirmed', // Validação da senha
      ]);

      // Criação do novo usuário
      User::create([
        'acesso_id' => $request->input('acesso_id'),
        'name' => $request->input('name'),
        'nome_completo' => $request->input('nome_completo'),
        'CPF' => $request->input('cpf'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')), // Usa a senha fornecida pelo usuário
      ]);

      return redirect()
        ->route('usuario.index')
        ->with('success', 'Usuário criado com sucesso.');
    } catch (\Exception $e) {
      return redirect()
        ->back()
        ->with('error', 'Erro ao cadastrar usuário');
    }
  }

  /**
   * Exibe o recurso especificado.
   */
  public function show(string $id)
  {
    $usuario = User::findOrFail($id);
    return view('admin.usuarios.show', compact('usuario'));
  }

  /**
   * Mostra o formulário para editar o recurso especificado.
   */
  public function edit(string $id)
  {
    $usuario = User::findOrFail($id);
    $tiposAcesso = TipoUsuario::all();
    return view('admin.usuarios.edit', compact('usuario', 'tiposAcesso'));
  }

  /**
   * Atualiza o recurso especificado no armazenamento.
   */
  public function update(Request $request, string $id)
  {
    try {
      $usuario = User::findOrFail($id);

      $data = [
        'acesso_id' => $request->input('acesso_id'),
        'name' => $request->input('name'),
        'nome_completo' => $request->input('nome_completo'),
        'CPF' => $request->input('cpf'),
        'email' => $request->input('email'),
      ];

      // Atualiza a senha apenas se um novo valor for fornecido
      if ($request->filled('password')) {
        $data['password'] = Hash::make($request->input('password'));
      }

      $usuario->update($data);

      session()->flash('global-success', 'Usuário atualizado com sucesso!');
      return redirect()->route('usuario.index');
    } catch (\Exception $e) {
      session()->flash('global-error', 'Erro ao atualizar usuário');
      return redirect()
        ->back()
        ->with('error', 'Erro ao atualizar usuário');
    }
  }

  /**
   * Remove o recurso especificado do armazenamento.
   */
  public function destroy(string $id)
  {
    try {
      $usuario = User::findOrFail($id);
      if (!$usuario) {
        throw new \Exception('Usuário não encontrado');
      }
      $usuario->delete();

      return redirect()
        ->route('usuario.index')
        ->with('success', 'Usuário deletado com sucesso.');
    } catch (\Exception $e) {
      return redirect()
        ->back()
        ->with('error', 'Erro ao deletar usuário: ' . $e->getMessage());
    }
  }
}
