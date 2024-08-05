<!-- Botão para abrir o modal -->
<div>
    <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#cadastrarUsuario">
        Novo
    </button>

    <!-- Modal -->
    <div class="modal fade" id="cadastrarUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="cadastrarUsuarioLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="cadastrarUsuarioLabel">Cadastrar Novo Usuário</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('usuario.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="name">Nome de Usuário *</label>
                                    <input class="form-control" type="text" id="name" name="name" required />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="nome_completo">Nome Completo do Usuário *</label>
                                    <input class="form-control" type="text" id="nome_completo" name="nome_completo" required />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="cpf">CPF do Usuário *</label>
                                    <input class="form-control" type="text" id="cpf" name="cpf" required />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="email">E-mail do Usuário *</label>
                                    <input class="form-control" type="email" id="email" name="email" required />
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label for="acesso_id">Tipo de Acesso *</label>
                                    <select name="acesso_id" class="form-select">
                <option selected disabled>Selecione</option>
                @foreach($tipos as $tipo)
                    <option value="{{ $tipo->id }}" {{ (isset($usuario) && $usuario->acesso_id == $tipo->id) ? 'selected' : '' }}>{{ $tipo->descricao }}</option>
                @endforeach
            </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success w-100">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
