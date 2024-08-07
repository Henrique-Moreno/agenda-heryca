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
    TipoUsuario::updateOrCreate(['id' => 1], ['descricao' => 'Admin']);

    TipoUsuario::updateOrCreate(['id' => 2], ['descricao' => 'Servidor']);

    TipoUsuario::updateOrCreate(['id' => 3], ['descricao' => 'Aluno']);
  }

  /**
   * Cadastra o usuário administrador
   *
   * @return void
   */
  protected function createUser()
  {
    User::updateOrCreate(
      ['email' => 'admistrador.agendas@ifnmg'],
      [
        'name' => 'Admistrador',
        'nome_completo' => 'Administrador completo',
        'CPF' => '11000000000', // Use um CPF fictício ou adequado
        'password' => Hash::make('acesso@admin2024'),
        'acesso_id' => 1,
      ]
    );

    User::updateOrCreate(
      ['email' => 'claudio.agendas@aluno.ifnmg'],
      [
        'name' => 'Claudio',
        'nome_completo' => 'Claudio',
        'CPF' => '77866644433', // Use um CPF fictício ou adequado
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
    ]);

    Cargo::updateOrCreate([
      'descricao' => 'Médico(a)',
    ]);

    Cargo::updateOrCreate([
      'descricao' => 'Pedagogo(a)',
    ]);
  }

}
