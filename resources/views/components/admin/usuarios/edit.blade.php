<!-- Button trigger modal -->
<button type="button" class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#editarUsuario-{{ $usuario->id }}">
    Editar
</button>

<!-- Modal -->
<div class="modal fade" id="editarUsuario-{{ $usuario->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ $usuario->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('usuario.update', $usuario->id) }}" method="POST">
                    @csrf
                    <x-admin.usuarios.form :usuario="$usuario" :tipos="$tipos"/>
                </form>
            </div>
        </div>
    </div>
</div>