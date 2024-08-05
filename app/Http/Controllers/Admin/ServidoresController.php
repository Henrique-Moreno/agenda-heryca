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

      $usuario = $this->usuariosService->store($request, 2);

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

  public function edit(string $id)
  {
    $servidor = Servidor::findOrFail($id);
    $cargos = Cargo::all();
    return view('servidores.edit', compact('servidor', 'cargos'));
  }

  public function update(Request $request, string $id)
  {
    try {
      DB::beginTransaction();

      $servidor = Servidor::findOrFail($id);

      $usuario = $this->usuariosService->update($servidor->usuario_id, $request, 2);

      $servidor->update([
        'cargo_id' => $request->input('cargo_id'),
      ]);

      DB::commit();
      session()->flash('global-success', 'Servidor atualizado com sucesso!');
      return redirect()->route('servidores');
    } catch (Exception $e) {
      DB::rollback();
      return $e->getMessage();
    }
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
