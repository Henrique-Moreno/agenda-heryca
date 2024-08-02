<?php
namespace App\Services\Admin;

use stdClass;
use App\Models\User;
use Hash;

class UsuariosService
{
  public function store($params, $tipo)
  {
    return User::create([
      'name' => $params->nome,
      'nome_completo' => $params->nome,
      'CPF' => $params->cpf,
      'email' => $params->email,
      'password' => Hash::make($params->cpf),
      'acesso_id' => $tipo,
    ]);
  }

  public function update($id, $params, $tipo)
  {
    $user = User::find($id);

    return $user->update([
      'name' => $params->nome,
      'nome_completo' => $params->nome,
      'CPF' => $params->cpf,
      'acesso_id' => $tipo,
    ]);
  }
}
