<?php

use App\Http\Controllers\Admin\ServidoresController;

Route::controller(ServidoresController::class)->prefix('servidores')->group(function(){
    Route::get('show', 'index')->name('servidores.index');
    Route::post('store', 'store')->name('servidores.store');
    Route::post('update/{id}', 'update')->name('servidores.update');
    Route::get('delete/{id}', 'destroy')->name('servidores.delete');
});
