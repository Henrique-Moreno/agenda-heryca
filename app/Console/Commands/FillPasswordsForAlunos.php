<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Aluno;
use Illuminate\Support\Facades\Hash;

class FillPasswordsForAlunos extends Command
{
  protected $signature = 'alunos:fill-passwords';
  protected $description = 'Fill passwords for existing Aluno records';

  public function __construct()
  {
    parent::__construct();
  }

  public function handle()
  {
    Aluno::whereNull('password')->update(['password' => Hash::make('default_password')]);
    $this->info('Passwords filled for existing Aluno records.');
  }
}
