<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servidor extends Model
{
  use HasFactory;
  protected $table = 'servidores';

  protected $fillable = ['usuario_id', 'cargo_id'];

  public function usuario()
  {
    return $this->belongsTo(User::class, 'usuario_id');
  }

  public function cargo()
  {
    return $this->belongsTo(Cargo::class, 'cargo_id');
  }

  public function prontuarios()
  {
    return $this->hasMany(Prontuario::class, 'id_servidor');
  }
}
