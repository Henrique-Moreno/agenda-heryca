<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
  use HasFactory;

  protected $fillable = ['usuario_id', 'curso_id', 'codigo_matricula', 'codigo_turma'];

  /**
   * estabelece o relacionamento entre a model aluno e usuário
   * um aluno pertence a um usuário
   * @return void
   */
  public function usuario()
  {
    return $this->belongsTo(User::class, 'usuario_id');
  }

  /**
   * estabelece o relacionamento entre a model aluno e usuário
   * um aluno pertence a um usuário
   * @return void
   */
  public function curso()
  {
    return $this->belongsTo(Curso::class, 'curso_id');
  }

  public function prontuarios()
  {
    return $this->belongsTo(Prontuario::class, 'id_aluno');
  }
}
