<!-- Button trigger modal -->
<button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#criarUsuario">
    Novo
</button>
<!-- Modal -->
<div class="modal fade" id="criarUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Criar novo usuário</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('usuario.store') }}" method="POST">
                    @csrf
                    <x-admin.usuarios.form :tipos="$tipos"/>
                </form>
            </div>
        </div>
    </div>
</div>