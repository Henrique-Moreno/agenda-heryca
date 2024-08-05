<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Aluno extends Model
{
  use HasFactory;

  protected $fillable = ['usuario_id', 'curso_id', 'codigo_matricula', 'codigo_turma', 'password']; // Adicione 'password' aqui

  // Relacionamento entre a model aluno e usuário
  public function usuario()
  {
    return $this->belongsTo(User::class, 'usuario_id');
  }

  // Relacionamento entre a model aluno e curso
  public function curso()
  {
    return $this->belongsTo(Curso::class, 'curso_id');
  }

  // Relacionamento entre a model aluno e prontuário
  public function prontuarios()
  {
    return $this->belongsTo(Prontuario::class, 'id_aluno');
  }

  // Mutator para hash da senha antes de salvar
  public function setPasswordAttribute($value)
  {
    $this->attributes['password'] = Hash::make($value);
  }
}
