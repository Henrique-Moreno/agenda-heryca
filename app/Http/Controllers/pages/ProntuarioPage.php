<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Prontuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProntuarioPage extends Controller
{
  /**
   * Exibe uma lista dos recursos e o formulário de cadastro.
   */
  public function index(Request $request)
  {
    $file_path = storage_path('fallback_data/prontuario.json');

    $prontuarios = [];
    if (File::exists($file_path)) {
      $prontuarios = json_decode(File::get($file_path), true);
    }

    $search = $request->input('search');

    if ($search) {
      $prontuarios = array_filter($prontuarios, function ($prontuario) use ($search) {
        return strpos($prontuario['observacao'], $search) !== false ||
          strpos($prontuario['terapia'], $search) !== false ||
          strpos($prontuario['medicacao'], $search) !== false ||
          strpos($prontuario['nome_aluno'], $search) !== false;
      });
    }

    return view('content.pages.pages-prontuario', ['prontuarios' => $prontuarios]);
  }

  /**
   * Armazena um novo recurso.
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'nome_aluno' => 'required|string',
      'observacao' => 'required|string',
      'terapia' => 'required|string',
      'medicacao' => 'required|string',
    ]);

    // Criar o prontuário no banco de dados
    $prontuario = Prontuario::create([
      'id_servidor' => 1, // ID padrão do servidor
      'id_aluno' => 1, // ID padrão do aluno
      'observacao' => $validated['observacao'],
      'terapia' => $validated['terapia'],
      'medicacao' => $validated['medicacao'],
    ]);

    // Dados a serem salvos no JSON
    $json_data = [
      'id' => $prontuario->id,
      'nome_aluno' => $validated['nome_aluno'],
      'observacao' => $validated['observacao'],
      'terapia' => $validated['terapia'],
      'medicacao' => $validated['medicacao'],
    ];

    // Caminho para o arquivo JSON
    $file_path = storage_path('fallback_data/prontuario.json');

    // Certifique-se de que o diretório existe
    $directory = dirname($file_path);
    if (!File::exists($directory)) {
      File::makeDirectory($directory, 0755, true);
    }

    // Ler o conteúdo atual do arquivo JSON
    $json_content = [];
    if (File::exists($file_path)) {
      $json_content = json_decode(File::get($file_path), true);
    }

    // Adicionar o novo prontuário aos dados existentes
    $json_content[] = $json_data;

    // Salvar os dados atualizados de volta ao arquivo JSON
    File::put($file_path, json_encode($json_content, JSON_PRETTY_PRINT));

    return redirect()
      ->route('prontuario.index')
      ->with('success', 'Prontuário cadastrado com sucesso!');
  }

  /**
   * Atualiza um recurso existente.
   */
  public function update(Request $request, $id)
  {
    $validated = $request->validate([
      'nome_aluno' => 'required|string',
      'observacao' => 'required|string',
      'terapia' => 'required|string',
      'medicacao' => 'required|string',
    ]);

    $file_path = storage_path('fallback_data/prontuario.json');

    if (File::exists($file_path)) {
      $json_content = json_decode(File::get($file_path), true);

      foreach ($json_content as &$prontuario) {
        if ($prontuario['id'] == $id) {
          $prontuario = array_merge($prontuario, $validated);
          break;
        }
      }

      File::put($file_path, json_encode($json_content, JSON_PRETTY_PRINT));
    }

    return redirect()
      ->route('prontuario.index')
      ->with('success', 'Prontuário atualizado com sucesso!');
  }

  /**
   * Remove um recurso existente.
   */
  public function destroy($id)
  {
    $file_path = storage_path('fallback_data/prontuario.json');

    if (File::exists($file_path)) {
      $json_content = json_decode(File::get($file_path), true);

      $json_content = array_filter($json_content, function ($prontuario) use ($id) {
        return $prontuario['id'] != $id;
      });

      File::put($file_path, json_encode(array_values($json_content), JSON_PRETTY_PRINT));
    }

    return redirect()
      ->route('prontuario.index')
      ->with('success', 'Prontuário excluído com sucesso!');
  }
}
