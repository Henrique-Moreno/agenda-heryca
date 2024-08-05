<?php

namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UsuariosService
{
  /**
   * Store a new user in the database.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $tipo
   * @return \App\Models\User
   */
  public function store(Request $request, int $tipo): User
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
  public function update(int $id, Request $request, int $tipo): bool
  {
    try {
      $user = User::findOrFail($id);

      $data = [
        'name' => $request->input('nome'),
        'nome_completo' => $request->input('nome'),
        'CPF' => $request->input('cpf'),
        'acesso_id' => $tipo,
      ];

      // Update password if provided
      if ($request->filled('password')) {
        $data['password'] = Hash::make($request->input('password'));
      }

      return $user->update($data);
    } catch (ModelNotFoundException $e) {
      // Handle the case where the user is not found
      throw $e; // Or return a more user-friendly response
    }
  }
}
