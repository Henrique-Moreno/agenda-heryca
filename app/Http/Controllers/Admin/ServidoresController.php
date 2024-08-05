<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Servidor;
use App\Models\Cargo;
use App\Services\Admin\UsuariosService;
use Illuminate\Http\Request;
use DB;
use Exception;

class ServidoresController extends Controller
{
  public function __construct(protected UsuariosService $usuariosService)
  {
    $this->usuariosService = $usuariosService;
  }

  public function index()
  {
    $servidores = Servidor::with('usuario', 'cargo')->get();
    $cargos = Cargo::orderBy('descricao', 'ASC')->get();

    return view('admin.servidores.pages-servidores')
      ->with('servidores', $servidores)
      ->with('cargos', $cargos);
  }

  public function create()
  {
    $cargos = Cargo::all();
    return view('servidores.create', compact('cargos'));
  }

  public function store(Request $request)
  {
    try {
      DB::beginTransaction();

      // Validar a entrada do usuário
      $request->validate([
        'nome' => 'required|string',
        'email' => 'required|email',
        'cpf' => 'required|string',
        'cargo_id' => 'required|exists:cargos,id',
        'password' => 'required|string|min:6', // Validação da senha
      ]);

      // Criar o usuário com a senha
      $usuario = $this->usuariosService->store($request, 2);

      // Criar o servidor associado ao usuário
      $servidor = Servidor::create([
        'usuario_id' => $usuario->id,
        'cargo_id' => $request->input('cargo_id'),
      ]);

      DB::commit();
      session()->flash('global-success', 'Servidor cadastrado com sucesso!');
      return redirect()->route('servidores');
    } catch (Exception $e) {
      DB::rollback();
      return $e->getMessage();
    }
  }

  public function update($id, $request, $tipo)
  {
    try {
      $user = User::findOrFail($id);

      $user->update([
        'name' => $request->input('name'),
        'nome_completo' => $request->input('nome_completo'),
        'CPF' => $request->input('cpf'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')), // Atualize a senha se fornecida
        'acesso_id' => $tipo,
      ]);

      return true;
    } catch (ModelNotFoundException $e) {
      throw $e; // Ou retorne uma resposta amigável
    }
  }

  public function edit(string $id)
  {
    $servidor = Servidor::findOrFail($id);
    $cargos = Cargo::all();
    return view('servidores.edit', compact('servidor', 'cargos'));
  }

  public function destroy(string $id)
  {
    try {
      DB::beginTransaction();

      $servidor = Servidor::findOrFail($id);
      $servidor->delete();

      DB::commit();
      session()->flash('global-success', 'Servidor removido com sucesso!');
      return redirect()->route('servidores.index');
    } catch (Exception $e) {
      DB::rollback();
      return $e->getMessage();
    }
  }
}
