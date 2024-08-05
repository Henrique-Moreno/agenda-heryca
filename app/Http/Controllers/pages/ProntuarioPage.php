<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Prontuario;
use App\Models\Servidor;
use App\Models\Aluno;
use Illuminate\Http\Request;

class ProntuarioPage extends Controller
{
  /**
   * Exibe uma lista dos recursos e o formulário de cadastro.
   */
  public function index(Request $request)
  {
    $prontuarios = Prontuario::all();
        $servidores = Servidor::all();  // Buscar todos os servidores
        $alunos = Aluno::all();
    $search = $request->input('search'); // Captura o termo de busca

    // Inicializa a consulta
    $query = Prontuario::query();

    // Adiciona condição de busca se o termo de busca for fornecido
    if ($search) {
      $query
        ->whereHas('servidor', function ($q) use ($search) {
          $q->where('nome_completo', 'like', "%{$search}%"); // Ajuste para o nome correto da coluna
        })
        ->orWhereHas('aluno', function ($q) use ($search) {
          $q->where('nome_aluno', 'like', "%{$search}%"); // Ajuste para o nome correto da coluna
        });


    }
    return view('content.pages.pages-prontuario', compact('prontuarios', 'servidores', 'alunos'));
  }

  /**
   * Armazena um novo recurso.
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'id_servidor' => 'required|exists:servidores,id',
      'id_aluno' => 'required|exists:alunos,id',
      'observacao' => 'required|string',
      'terapia' => 'required|string',
      'medicacao' => 'required|string',
    ]);

    Prontuario::create($validated);

    return redirect()
      ->route('prontuario.index')
      ->with('success', 'Prontuário cadastrado com sucesso!');
  }
}
