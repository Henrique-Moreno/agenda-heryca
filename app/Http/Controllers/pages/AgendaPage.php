<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AgendaPage extends Controller
{
  public function show()
  {
    $servidores = $this->loadServidores();
    return view('content.pages.pages-agenda', ['servidores' => $servidores]);
  }

  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'servidor_id' => 'required|integer',
      'id_aluno' => 'required|integer',
      'nome' => 'required|string|max:255',
      'data' => 'required|date',
      'horario' => 'required|string',
      'status' => 'required|string',
    ]);

    $servidores = $this->loadServidores();
    $servidorId = $validatedData['servidor_id'];
    $novoAgenda = [
      'id_aluno' => $validatedData['id_aluno'],
      'nome' => $validatedData['nome'],
      'data' => $validatedData['data'],
      'horario' => $validatedData['horario'],
      'status' => $validatedData['status'],
    ];

    $atualizado = false;
    foreach ($servidores as &$servidor) {
      if ($servidor['id'] == $servidorId) {
        if (!isset($servidor['agenda'])) {
          $servidor['agenda'] = [];
        }
        $servidor['agenda'][] = $novoAgenda;
        $atualizado = true;
        break;
      }
    }

    if ($atualizado) {
      $this->saveServidores($servidores);
      return redirect()
        ->route('agenda.show')
        ->with('success', 'Agenda criada com sucesso!');
    } else {
      return redirect()
        ->route('agenda.show')
        ->with('error', 'Servidor não encontrado.');
    }
  }

  public function update(Request $request, $servidorId, $agendaId)
  {
    // Carregar os servidores
    $servidores = $this->loadServidores();

    $atualizado = false;

    // Percorrer os servidores para encontrar o servidor e a agenda correta
    foreach ($servidores as &$servidor) {
      if ($servidor['id'] == $servidorId) {
        foreach ($servidor['agenda'] as &$agenda) {
          if ($agenda['id_aluno'] == $agendaId) {
            // Atualizar os dados da agenda
            $agenda['nome'] = $request->input('nome');
            $agenda['data'] = $request->input('data'); // Verifique se a data está no formato esperado
            $agenda['horario'] = $request->input('horario');
            $agenda['status'] = $request->input('status');
            $atualizado = true;
            break 2; // Sair dos dois loops
          }
        }
      }
    }

    if ($atualizado) {
      // Salvar as atualizações no arquivo JSON
      $this->saveServidores($servidores);
      return redirect()
        ->route('agenda.show')
        ->with('success', 'Agenda atualizada com sucesso!');
    } else {
      return redirect()
        ->route('agenda.show')
        ->with('error', 'Agenda não encontrada.');
    }
  }

  public function destroy($servidorId, $agendaId)
  {
    $servidores = $this->loadServidores();

    $atualizado = false;
    foreach ($servidores as &$servidor) {
      if ($servidor['id'] == $servidorId) {
        $servidor['agenda'] = array_filter($servidor['agenda'], function ($agenda) use ($agendaId) {
          return $agenda['id_aluno'] != $agendaId;
        });
        $atualizado = true;
        break;
      }
    }

    if ($atualizado) {
      $this->saveServidores($servidores);
      return redirect()
        ->route('agenda.show')
        ->with('success', 'Agenda excluída com sucesso!');
    } else {
      return redirect()
        ->route('agenda.show')
        ->with('error', 'Agenda não encontrada.');
    }
  }

  private function loadServidores()
  {
    $jsonPath = database_path('fallback_data/servidores.json');
    if (File::exists($jsonPath)) {
      $jsonData = File::get($jsonPath);
      return json_decode($jsonData, true);
    } else {
      return [];
    }
  }

  private function saveServidores($servidores)
  {
    $jsonPath = database_path('fallback_data/servidores.json');
    File::put($jsonPath, json_encode($servidores, JSON_PRETTY_PRINT));
  }
}
