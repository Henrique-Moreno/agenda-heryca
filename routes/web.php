<?php

use Illuminate\Support\Facades\Route; // Add this line

use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\pages\HorariosPage;
use App\Http\Controllers\pages\ProntuarioPage;
use App\Http\Controllers\pages\AgendasPage;
use App\Http\Controllers\pages\Page2;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\AlunosController; // Add this line
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

// Página para ver horários disponíveis
Route::match(['get', 'post'], '/ver-horarios', [HorariosPage::class, 'verHorarios'])->name('ver-horarios');

// prontuário eletrônico
Route::match(['get', 'post'], '/prontuarios', [ProntuarioPage::class, 'index'])->name('prontuarios.index');

// locale
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

// pages
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');

Route::middleware(['auth', 'check_institutional_email'])->group(function () {
  Route::prefix('admin')->group(base_path('routes/admin/usuarios.php'));
  Route::prefix('admin')->group(base_path('routes/admin/alunos.php'));
  Route::prefix('admin')->group(base_path('routes/admin/servidores.php'));

  // Página para ver agendas
  Route::match(['get', 'post'], '/agendas', [AgendasPage::class, 'index'])->name('agendas.index');
});

