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
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $servidores = Servidor::with('usuario', 'cargo')->get();
    $cargos = Cargo::orderBy('descricao', 'ASC')->get();

    return view('admin.servidores.index')
      ->with('servidores', $servidores)
      ->with('cargos', $cargos);
    //
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $cargos = Cargo::all();
    return view('view', compact('cargos'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    try {
      DB::beginTransaction();

      $usuario = $this->usuariosService->store($request, 3);

      $servidor = Servidor::create([
        'usuario_id' => $usuario->id,
        'cargo_id' => $request->input('cargo_id'),
      ]);

      DB::commit();
      session()->flash('global-success', 'Servidor cadastrado com sucesso!');
      return redirect()->route('servidores.index');
    } catch (Exception $e) {
      return $e->getMessage();
    }
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    try {
      DB::beginTransaction();

      $servidor = Servidor::find($id);

      $usuario = $this->usuariosService->update($servidor->usuario_id, $request, 3);

      $servidor->update([
        'cargo_id' => $request->input('cargo_id'),
      ]);

      DB::commit();
      session()->flash('global-success', 'Servidor atualizado com sucesso!');
      return redirect()->route('admin.servidores.index');
    } catch (Exception $e) {
      return $e->getMessage();
    }
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
