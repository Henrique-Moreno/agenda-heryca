<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servidor;
use App\Models\Agenda;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servidor;
use App\Models\Agenda;
use Illuminate\Support\Facades\File;

class HorariosPage extends Controller
{
  public function verHorarios(Request $request)
  {
    // Valida se o ID do servidor foi enviado
    $request->validate([
      'servidor_id' => 'required|integer',
    ]);

    // Obtém o ID do servidor da requisição
    $servidorId = $request->input('servidor_id');

    // Tenta carregar os dados do banco de dados
    $servidor = Servidor::with(['usuario', 'cargo'])->find($servidorId);

    // Se não houver dados no banco, carrega os dados do arquivo JSON
    if (!$servidor) {
      $jsonPath = database_path('fallback_data/servidores.json');
      if (File::exists($jsonPath)) {
        $jsonData = File::get($jsonPath);
        $servidores = collect(json_decode($jsonData, true));
        $servidorArray = $servidores->firstWhere('id', $servidorId);
        if ($servidorArray) {
          // Converte o array para um objeto
          $servidor = json_decode(json_encode($servidorArray));
        }
      }
    }

    // Verifica se o servidor foi encontrado
    if (!$servidor) {
      abort(404, 'Servidor não encontrado.');
    }

    // Passa o servidor específico para a view
    return view('content.pages.pages-horarios', ['servidor' => $servidor]);
  }

  public function agendar(Request $request)
  {
    // Validação dos dados recebidos
    $validated = $request->validate([
      'servidor_id' => 'required|integer',
      'id_aluno' => 'required|integer',
      'dia' => 'required|date',
      'horario' => 'required',
    ]);

    // Criação da nova agenda
    $agenda = new Agenda();
    $agenda->id_servidor = $validated['servidor_id'];
    $agenda->id_aluno = $validated['id_aluno'];
    $agenda->data = $validated['dia'];
    $agenda->horario = $validated['horario'];
    $agenda->status = 'confirmado';
    $agenda->save();

    // Redireciona para a página de agenda com uma mensagem de sucesso
    return redirect()
      ->route('agenda.show')
      ->with('success', 'Consulta agendada com sucesso!');
  }
}
