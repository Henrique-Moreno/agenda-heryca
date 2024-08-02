<?php

use App\Http\Controllers\Admin\UsuariosController;

Route::controller(UsuariosController::class)
  ->prefix('usuarios')
  ->group(function () {
    // Route::get('show', 'index')->name('usuarios.index')->middleware('admin');
    Route::get('show', 'index')->name('usuario.index');
    Route::post('store', 'store')->name('usuarios.store');
    Route::post('update/{id}', 'update')->name('usuarios.update');
  });


