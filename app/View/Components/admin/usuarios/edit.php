<?php

namespace App\View\Components\admin\usuarios;

use App\Models\TipoUsuario;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class edit extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public object $usuario)
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $tipos = TipoUsuario::all();
        
        return view('components.admin.usuarios.edit')
            ->with('tipos', $tipos);
    }
}
