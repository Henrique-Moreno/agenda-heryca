<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\Servidor;
use Illuminate\Support\Facades\File;

class AgendaPage extends Controller
{
  public function show()
  {
    // Tenta carregar os dados do banco de dados
    $agendas = Agenda::with('servidor.usuario')->get();

    // Se não houver dados no banco, carrega os dados do arquivo JSON
    if ($agendas->isEmpty()) {
      $jsonPath = database_path('fallback_data/agenda.json');
      if (File::exists($jsonPath)) {
        $jsonData = File::get($jsonPath);
        $agendas = collect(json_decode($jsonData, true));
      } else {
        $agendas = collect(); // Retorna uma coleção vazia se o arquivo JSON não existir
      }
    }

    return view('content.pages.pages-agenda', ['agendas' => $agendas]);
  }

  public function cancel($id)
  {
    // Encontre a agenda pelo ID
    $agenda = Agenda::find($id);

    if ($agenda) {
      // Atualize o status para 'cancelado' ou qualquer outro valor necessário
      $agenda->status = 'cancelado';
      $agenda->save();
    }

    // Redirecione de volta para a página de agenda com uma mensagem de sucesso
    return redirect()
      ->route('agenda.show')
      ->with('success', 'Agenda cancelada com sucesso!');
  }
}
