<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendasPage extends Controller
{
  public function index()
  {
    // Obtém todos os registros da tabela 'agendas'
    $agendas = Agenda::all();

    // Retorna a pagina com os dados das agendas
    return view('content.pages.pages-agendas', compact('agendas'));
  }
}
