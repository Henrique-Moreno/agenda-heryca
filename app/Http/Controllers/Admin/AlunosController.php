<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Curso;
use App\Services\Admin\UsuariosService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Exception;

class AlunosController extends Controller
{
  public function __construct(protected UsuariosService $usuarioService)
  {
    $this->usuarioService = $usuarioService;
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $alunos = Aluno::with('usuario', 'curso')->get();
    $cursos = Curso::orderBy('descricao', 'ASC')->get();
    return view('admin.alunos.index')
      ->with('alunos', $alunos)
      ->with('cursos', $cursos);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $cursos = Curso::orderBy('descricao', 'ASC')->get();
    return view('admin.alunos.create', compact('cursos'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'nome' => 'required|string|max:255',
      'email' => 'required|email|max:255',
      'cpf' => 'required|string|max:14',
      'curso_id' => 'required|exists:cursos,id',
      'codigo_matricula' => 'required|string|max:30',
      'codigo_turma' => 'required|string|max:30',
      'password' => 'required|string|min:8|confirmed', // Validação para a senha
    ]);

    try {
      DB::beginTransaction();

      // Criar o usuário
      $usuario = $this->usuarioService->store($request, 3);

      // Criar o aluno
      Aluno::create([
        'usuario_id' => $usuario->id,
        'curso_id' => $request->input('curso_id'),
        'codigo_matricula' => $request->input('codigo_matricula'),
        'codigo_turma' => $request->input('codigo_turma'),
        'password' => Hash::make($request->input('password')), // Armazenar a senha criptografada
      ]);

      DB::commit();
      session()->flash('global-success', true);
      return redirect()->route('alunos.index');
    } catch (Exception $e) {
      DB::rollBack();
      return back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    // Implementar se necessário
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    // Implementar se necessário
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $request->validate([
      'curso_id' => 'required|exists:cursos,id',
      'codigo_matricula' => 'required|string|max:30',
      'codigo_turma' => 'required|string|max:30',
      'password' => 'nullable|string|min:8|confirmed', // Senha opcional
    ]);

    try {
      DB::beginTransaction();

      $aluno = Aluno::findOrFail($id);

      $userData = $request->only(['nome', 'cpf']);
      if ($request->filled('password')) {
        $userData['password'] = Hash::make($request->input('password')); // Criptografa a senha
      }
      $this->usuarioService->update($aluno->usuario_id, $request, 3);

      $aluno->update([
        'curso_id' => $request->input('curso_id'),
        'codigo_matricula' => $request->input('codigo_matricula'),
        'codigo_turma' => $request->input('codigo_turma'),
      ]);

      DB::commit();
      session()->flash('global-success', true);
      return redirect()->route('alunos.index');
    } catch (Exception $e) {
      DB::rollBack();
      return back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    try {
      $aluno = Aluno::findOrFail($id);
      $aluno->delete();

      session()->flash('global-success', 'Aluno removido com sucesso!');
      return redirect()->route('alunos.index');
    } catch (Exception $e) {
      return back()->withErrors(['error' => $e->getMessage()]);
    }
  }
}
