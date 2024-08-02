<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
  use HasFactory;

  protected $table = 'agendas';

  protected $fillable = ['id_servidor', 'id_aluno', 'data', 'horario', 'status'];

  public function servidor()
  {
    return $this->belongsTo(Servidor::class, 'id_servidor');
  }

  public function aluno()
  {
    return $this->belongsTo(Aluno::class, 'id_aluno');
  }
}
