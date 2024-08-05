<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\Curso;
use App\Models\Aluno;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoUsuario;
use App\Models\User;
use Hash;
use DB;

class DeploySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    try {
      DB::beginTransaction();

      $this->createTipoUsuario();
      $this->createUser();
      $this->createCursos();
      $this->createCargo();
      $this->createAluno();

      DB::commit();
    } catch (\Exception $e) {
      DB::rollback();
      throw $e; // Lançar a exceção para depuração
    }
  }

  /**
   * Cadastra os tipos de usuário
   *
   * @return void
   */
  protected function createTipoUsuario()
  {
    TipoUsuario::updateOrCreate(
      [
        'id' => 1,
      ],
      [
        'descricao' => 'Admin',
      ]
    );

    TipoUsuario::updateOrCreate(
      [
        'id' => 2,
      ],
      [
        'descricao' => 'Servidor',
      ]
    );

    TipoUsuario::updateOrCreate(
      [
        'id' => 3,
      ],
      [
        'descricao' => 'Aluno',
      ]
    );
  }

  /**
   * Cadastra o usuário administrador
   *
   * @return void
   */
  protected function createUser()
  {
    User::updateOrCreate(
      [
        'email' => 'admin.agendas@ifnmg',
      ],
      [
        'name' => 'Usuário Admin',
        'nome_completo' => 'Usuário Admin',
        'CPF' => '00000000000', // Use um CPF fictício ou adequado
        'password' => Hash::make('acesso@admin2024'),
        'acesso_id' => 1,
      ]
    );

    User::updateOrCreate(
      [
        'email' => 'lucas.agendas@aluno.ifnmg',
      ],
      [
        'name' => 'Usuário Aluno',
        'nome_completo' => 'Usuário Aluno',
        'CPF' => '88866644433', // Use um CPF fictício ou adequado
        'password' => Hash::make('acesso@aluno2024'),
        'acesso_id' => 3,
      ]
    );
  }

  /**
   * Cadastra os cursos da instituição
   *
   * @return void
   */
  protected function createCursos()
  {
    Curso::updateOrCreate([
      'descricao' => 'Análise e Desenvolvimento de Sistemas',
    ]);

    Curso::updateOrCreate([
      'descricao' => 'Engenharia Agronômica',
    ]);

    Curso::updateOrCreate([
      'descricao' => 'Processos Gerenciais',
    ]);
  }

  /**
   * Cadastra as opções de cargo dos servidores
   *
   * @return void
   */
  protected function createCargo()
  {
    Cargo::updateOrCreate([
      'descricao' => 'Psicólogo(a)',
      'descricao' => 'Medico(a)',
    ]);
  }

  /**
   * Cadastra alunos
   *
   * @return void
   */
  protected function createAluno()
  {
    $cursos = Curso::all();
    $users = User::where('acesso_id', 3)->get();

    foreach ($users as $user) {
      Aluno::updateOrCreate([
        'usuario_id' => $user->id,
        'curso_id' => $cursos->random()->id,
        'codigo_matricula' => 'M123456',
        'codigo_turma' => 'T123456',
      ]);
    }
  }
}
