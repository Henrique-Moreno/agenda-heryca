<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Curso;
use App\Services\Admin\UsuariosService;
use Illuminate\Http\Request;
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
        /**
         * consulta os alunos no banco de dados e guarda na variável $alunos
         * junto dessa consultam traz tbm os dados de usuário, ao qual o aluno pertence (Join)
         */
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $usuario = $this->usuarioService->store($request, 3);
            
            $aluno = Aluno::create([
                'usuario_id' => $usuario->id,
                'curso_id' => $request->input('curso_id'),
                'codigo_matricula' => $request->input('codigo_matricula'),
                'codigo_turma' => $request->input('codigo_turma'),
            ]);
            
            DB::commit();
            session()->flash('global-success', true);
            return redirect()->route('alunos.index');
        }catch(Exception $e) {
            return $e->getMessage();
        }
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
            
            $aluno = Aluno::find($id);
            
            $usuario = $this->usuarioService->update($aluno->usuario_id, $request, 3);
            
            $aluno->update([
                'curso_id' => $request->input('curso_id'),
                'codigo_matricula' => $request->input('codigo_matricula'),
                'codigo_turma' => $request->input('codigo_turma'),
            ]);
            
            DB::commit();
            session()->flash('global-success', true);
            return redirect()->route('alunos.index');
        } catch(Exception $e) {
            return $e->getMessage();
        }
    }   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
