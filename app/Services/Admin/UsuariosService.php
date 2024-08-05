<?php
namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsuariosService
{
  /**
   * Store a new user in the database.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $tipo
   * @return \App\Models\User
   */
  public function store($request, $tipo)
  {
    $user = User::create([
      'name' => $request->input('nome'),
      'nome_completo' => $request->input('nome'),
      'CPF' => $request->input('cpf'),
      'email' => $request->input('email'),
      'password' => Hash::make($request->input('cpf')), // Consider using a more secure password strategy
      'acesso_id' => $tipo,
    ]);

    return $user;
  }

  /**
   * Update an existing user in the database.
   *
   * @param int $id
   * @param \Illuminate\Http\Request $request
   * @param int $tipo
   * @return bool
   */
  public function update($id, $request, $tipo)
  {
    try {
      $user = User::findOrFail($id);

      return $user->update([
        'name' => $request->input('nome'),
        'nome_completo' => $request->input('nome'),
        'CPF' => $request->input('cpf'),
        'acesso_id' => $tipo,
      ]);
    } catch (ModelNotFoundException $e) {
      // Handle the case where the user is not found
      throw $e; // Or return a more user-friendly response
    }
  }
}
