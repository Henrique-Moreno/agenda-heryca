<?php

use Illuminate\Support\Facades\Route; // Add this line

use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\pages\HorariosPage;
use App\Http\Controllers\pages\ProntuarioPage;
use App\Http\Controllers\pages\AgendaPage;
use App\Http\Controllers\pages\Page2;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\Admin\AlunosController;
use App\Http\Controllers\Admin\ServidoresController;
use App\Http\Controllers\Admin\UsuariosController;
use App\Http\Controllers\Auth\AuthController;

Route::post('sign-in', [AuthController::class, 'Authenticate'])->name('sign-in');

Route::get('/', function () {
  return redirect()->route('auth-login-basic');
});

// authentication
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');

// Home
Route::match(['get', 'post'], '/home', [HomePage::class, 'index'])->name('home-page');
// Route::middleware(['check.access'])->group(function () {
//   Route::match(['get', 'post'], '/home', [HomePage::class, 'index'])->name('home-page');
// });


// Página para ver Agenda
Route::get('/agenda', [AgendaPage::class, 'show'])->name('agenda.show');
// Criar nova agenda (mostra o formulário)
Route::get('/agenda/create', [AgendaPage::class, 'create'])->name('agenda.create');
// Armazenar uma nova agenda
Route::post('/agenda', [AgendaPage::class, 'store'])->name('agenda.store');
// Rota para exibir o formulário de edição
Route::get('/agenda/edit/{servidorId}/{agendaId}', [AgendaPage::class, 'edit'])->name('agenda.edit');
// Atualizar uma agenda
Route::put('/agenda/{servidorId}/{agendaId}', [AgendaPage::class, 'update'])->name('agenda.update');
// Excluir uma agenda
Route::delete('/agenda/{servidorId}/{agendaId}', [AgendaPage::class, 'destroy'])->name('agenda.destroy');


// prontuário eletrônico
Route::match(['get', 'post'], '/prontuarios', [ProntuarioPage::class, 'index'])->name('prontuarios.index');
Route::get('/prontuario', [ProntuarioPage::class, 'index'])->name('prontuario.index');
Route::post('/prontuario', [ProntuarioPage::class, 'store'])->name('prontuario.store');
Route::get('/prontuario/search', [ProntuarioPage::class, 'search'])->name('prontuario.search');
Route::put('/prontuario/{id}', [ProntuarioPage::class, 'update'])->name('prontuario.update');
Route::delete('/prontuario/{id}', [ProntuarioPage::class, 'destroy'])->name('prontuario.destroy');


// Página para ver horários disponíveis
Route::match(['get', 'post'], '/ver-horarios', [HorariosPage::class, 'verHorarios'])->name('ver-horarios');


// Servidores
Route::get('/servidores', [ServidoresController::class, 'index'])->name('servidores');
Route::get('/servidores/create', [ServidoresController::class, 'create'])->name('servidores.create');
Route::post('/servidores', [ServidoresController::class, 'store'])->name('servidores.store');
Route::get('/servidores/{id}/edit', [ServidoresController::class, 'edit'])->name('servidores.edit');
Route::put('/servidores/{id}', [ServidoresController::class, 'update'])->name('servidores.update');
Route::delete('/servidores/{id}', [ServidoresController::class, 'destroy'])->name('servidores.destroy');
Route::get('/servidores/{id}/horarios', [ServidoresController::class, 'show'])->name('servidores.show');


// Rota Alunos
Route::get('/alunos', [AlunosController::class, 'index'])->name('alunos.index');
// Rota para mostrar o formulário para criar um novo aluno
Route::get('/alunos/create', [AlunosController::class, 'create'])->name('alunos.create');
// Rota para armazenar um novo aluno
Route::post('/alunos', [AlunosController::class, 'store'])->name('alunos.store');
// Rota para exibir os detalhes de um aluno específico
Route::get('/alunos/{id}', [AlunosController::class, 'show'])->name('alunos.show');
// Rota para mostrar o formulário para editar um aluno existente
Route::get('/alunos/{id}/edit', [AlunosController::class, 'edit'])->name('alunos.edit');
// Rota para atualizar um aluno existente
Route::put('/alunos/{id}', [AlunosController::class, 'update'])->name('alunos.update');
// Rota para deletar um aluno existente
Route::delete('/alunos/{id}', [AlunosController::class, 'destroy'])->name('alunos.destroy');


// Rota Usuário
Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios');
// Rota para criar um novo usuário
Route::get('/usuarios/create', [UsuariosController::class, 'create'])->name('usuario.create');
Route::post('/usuarios', [UsuariosController::class, 'store'])->name('usuario.store');
// Rota para exibir detalhes de um usuário
Route::get('/usuarios/{id}', [UsuariosController::class, 'show'])->name('usuario.show');
// Rota para editar um usuário
Route::get('/usuarios/{id}/edit', [UsuariosController::class, 'edit'])->name('usuario.edit');
Route::put('/usuarios/{id}', [UsuariosController::class, 'update'])->name('usuario.update');
// Rota para deletar um usuário
Route::delete('/usuarios/{id}', [UsuariosController::class, 'destroy'])->name('usuario.destroy');



// locale
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

// pages
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
