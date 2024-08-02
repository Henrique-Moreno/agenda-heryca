<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Prontuario;
use Illuminate\Http\Request;

class ProntuarioPage extends Controller
{
  /**
   * Exibe uma lista dos recursos.
   */
  public function index()
  {
    $prontuarios = Prontuario::all();
    return view('content.pages.pages-prontuario', compact('prontuarios'));
  }

  /**
   * Mostra o formulário para criar um novo recurso.
   */
  public function create()
  {
    return view('content.pages.pages-prontuario-create');
  }

  /**
   * Armazena um recurso recém-criado no armazenamento.
   */
  public function store(Request $request)
  {
    $request->validate([
      'id_servidor' => 'required|integer',
      'id_aluno' => 'required|integer',
      'observacao' => 'required|string',
      'terapia' => 'required|string',
      'medicacao' => 'required|string',
    ]);

    Prontuario::create($request->all());

    return redirect()
      ->route('prontuarios.index')
      ->with('success', 'Prontuário criado com sucesso.');
  }

  /**
   * Exibe o recurso especificado.
   */
  public function show(Prontuario $prontuario)
  {
    return view('content.pages.pages-prontuario-show', compact('prontuario'));
  }

  /**
   * Mostra o formulário para editar o recurso especificado.
   */
  public function edit(Prontuario $prontuario)
  {
    return view('content.pages.pages-prontuario-edit', compact('prontuario'));
  }

  /**
   * Atualiza o recurso especificado no armazenamento.
   */
  public function update(Request $request, Prontuario $prontuario)
  {
    $request->validate([
      'observacao' => 'required|string',
      'terapia' => 'required|string',
      'medicacao' => 'required|string',
    ]);

    $prontuario->update($request->all());

    return redirect()
      ->route('prontuarios.index')
      ->with('success', 'Prontuário atualizado com sucesso.');
  }

  /**
   * Remove o recurso especificado do armazenamento.
   */
  public function destroy(Prontuario $prontuario)
  {
    $prontuario->delete();

    return redirect()
      ->route('prontuarios.index')
      ->with('success', 'Prontuário deletado com sucesso.');
  }
}
