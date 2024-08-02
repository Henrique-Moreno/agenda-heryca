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
    // Obtém todos os tipos de acesso e usuários
    $tipoAcesso = TipoUsuario::all();
    $usuarios = User::all();

    // Retorna a view com os tipos de acesso e usuários
    return view('admin.usuarios.index')
      ->with('tipos', $tipoAcesso)
      ->with('usuarios', $usuarios);
  }

  /**
   * Mostra o formulário para criar um novo recurso.
   */
  public function create()
  {
    // Obtém todos os tipos de acesso para exibir no formulário de criação
    $tiposAcesso = TipoUsuario::all();

    // Retorna a view com os tipos de acesso
    return view('admin.usuarios.create', compact('tiposAcesso'));
  }

  /**
   * Armazena um recurso recém-criado no armazenamento.
   */
  public function store(Request $request)
  {
    try {
      // Cria um novo usuário com os dados fornecidos
      User::create([
        'acesso_id' => $request->acesso_id,
        'name' => $request->input('name'),
        'nome_completo' => $request->input('nome_completo'),
        'CPF' => $request->input('cpf'),
        'email' => $request->input('email'),
        'password' => Hash::make('teste123'), // Define uma senha padrão para o novo usuário
      ]);

      // Redireciona para a rota de índice de usuários com sucesso
      return redirect()->route('usuario.index');
    } catch (\Exception $e) {
      // Redireciona de volta com mensagem de erro em caso de falha
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
    // Obtém o usuário pelo ID
    $usuario = User::findOrFail($id);

    // Retorna a view com os detalhes do usuário
    return view('admin.usuarios.show', compact('usuario'));
  }

  /**
   * Mostra o formulário para editar o recurso especificado.
   */
  public function edit(string $id)
  {
    // Obtém o usuário pelo ID e os tipos de acesso
    $usuario = User::findOrFail($id);
    $tiposAcesso = TipoUsuario::all();

    // Retorna a view com o usuário e tipos de acesso para edição
    return view('admin.usuarios.edit', compact('usuario', 'tiposAcesso'));
  }

  /**
   * Atualiza o recurso especificado no armazenamento.
   */
  public function update(Request $request, string $id)
  {
    try {
      // Encontra o usuário pelo ID e atualiza com os dados fornecidos
      $usuario = User::findOrFail($id);

      $usuario->update([
        'acesso_id' => $request->input('acesso_id'),
        'name' => $request->input('name'),
        'nome_completo' => $request->input('nome_completo'),
        'CPF' => $request->input('cpf'),
        'email' => $request->input('email'),
        'password' => Hash::make('teste123'), // Atualiza a senha com um valor padrão
      ]);

      // Define uma mensagem de sucesso e redireciona para a rota de índice de usuários
      session()->flash('global-success', true);
      return redirect()->route('usuario.index');
    } catch (\Exception $e) {
      // Define uma mensagem de erro e redireciona de volta em caso de falha
      session()->flash('global-error', true);
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
      // Encontra o usuário pelo ID e o exclui
      $usuario = User::findOrFail($id);
      $usuario->delete();

      // Redireciona para a rota de índice de usuários com mensagem de sucesso
      return redirect()
        ->route('usuario.index')
        ->with('success', 'Usuário deletado com sucesso.');
    } catch (\Exception $e) {
      // Redireciona de volta com mensagem de erro em caso de falha
      return redirect()
        ->back()
        ->with('error', 'Erro ao deletar usuário');
    }
  }
}
