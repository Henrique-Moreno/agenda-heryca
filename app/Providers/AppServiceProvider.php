<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    // Registrar os componentes Blade
    Blade::component('admin.servidores.create', \App\View\Components\Admin\Servidores\Create::class);
    Blade::component('admin.servidores.edit', \App\View\Components\Admin\Servidores\Edit::class);
  }
}
