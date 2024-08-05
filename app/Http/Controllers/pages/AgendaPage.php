<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AgendaPage extends Controller
{
  public function show()
  {
    $agendas = $this->loadAgendas();
    return view('content.pages.pages-agenda', ['agendas' => $agendas]);
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'nome' => 'required|string|max:255',
      'horario' => 'required|string',
      'status' => 'required|string',
    ]);

    $agendas = $this->loadAgendas();

    // Gerar um novo ID para a agenda
    $newId = end($agendas)['id'] + 1;

    $newAgenda = [
      'id' => $newId,
      'nome' => $validatedData['nome'],
      'horario' => $validatedData['horario'],
      'status' => $validatedData['status'],
      'id_servidor' => null, // Ajuste conforme necessário
      'id_aluno' => null, // Ajuste conforme necessário
    ];

    $agendas[] = $newAgenda;
    $this->saveAgendas($agendas);

    return redirect()
      ->route('agenda.show')
      ->with('success', 'Agenda criada com sucesso!');
  }

  public function update(Request $request, $id)
  {
    $agendas = $this->loadAgendas();

    foreach ($agendas as &$agenda) {
      if ($agenda['id'] == $id) {
        $agenda['nome'] = $request->input('nome');
        $agenda['horario'] = $request->input('horario');
        $agenda['status'] = $request->input('status');
        break;
      }
    }

    $this->saveAgendas($agendas);
    return redirect()
      ->route('agenda.show')
      ->with('success', 'Agenda atualizada com sucesso!');
  }

  public function destroy($id)
  {
    $agendas = $this->loadAgendas();
    $agendas = array_filter($agendas, function ($agenda) use ($id) {
      return $agenda['id'] != $id;
    });

    $this->saveAgendas($agendas);
    return redirect()
      ->route('agenda.show')
      ->with('success', 'Agenda excluída com sucesso!');
  }

  private function loadAgendas()
  {
    $jsonPath = database_path('fallback_data/agenda.json');
    if (File::exists($jsonPath)) {
      $jsonData = File::get($jsonPath);
      return json_decode($jsonData, true);
    } else {
      return [];
    }
  }

  private function saveAgendas($agendas)
  {
    $jsonPath = database_path('fallback_data/agenda.json');
    File::put($jsonPath, json_encode($agendas, JSON_PRETTY_PRINT));
  }
}
