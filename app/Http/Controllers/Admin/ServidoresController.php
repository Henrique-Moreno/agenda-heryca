<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Servidor;
use App\Models\Cargo;
use App\Models\User; // Importar o modelo User
use App\Services\Admin\UsuariosService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

      $request->validate([
        'nome' => 'required|string',
        'email' => 'required|email',
        'cpf' => 'required|string',
        'cargo_id' => 'required|exists:cargos,id',
        'password' => 'required|string|min:6',
      ]);

      $usuario = $this->usuariosService->store($request, 2);

      Servidor::create([
        'usuario_id' => $usuario->id,
        'cargo_id' => $request->input('cargo_id'),
      ]);

      DB::commit();
      session()->flash('global-success', 'Servidor cadastrado com sucesso!');
      return redirect()->route('servidores');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()
        ->route('servidores')
        ->with('global-error', 'Erro ao cadastrar servidor: ' . $e->getMessage());
    }
  }

  public function update(Request $request, $id)
  {
    try {
      $user = User::findOrFail($id);

      $request->validate([
        'name' => 'required|string',
        'nome_completo' => 'required|string',
        'cpf' => 'required|string',
        'email' => 'required|email',
        'password' => 'nullable|string|min:6',
      ]);

      $user->update([
        'name' => $request->input('name'),
        'nome_completo' => $request->input('nome_completo'),
        'cpf' => $request->input('cpf'), // Certifique-se de que o campo é 'cpf' e não 'CPF'
        'email' => $request->input('email'),
        'password' => $request->filled('password') ? Hash::make($request->input('password')) : $user->password,
      ]);

      return redirect()
        ->route('servidores')
        ->with('global-success', 'Servidor atualizado com sucesso!');
    } catch (ModelNotFoundException $e) {
      return redirect()
        ->route('servidores')
        ->with('global-error', 'Servidor não encontrado!');
    } catch (Exception $e) {
      return redirect()
        ->route('servidores')
        ->with('global-error', 'Erro ao atualizar servidor: ' . $e->getMessage());
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
      return redirect()->route('servidores');
    } catch (Exception $e) {
      DB::rollback();
      return redirect()
        ->route('servidores')
        ->with('global-error', 'Erro ao remover servidor: ' . $e->getMessage());
    }
  }
}
