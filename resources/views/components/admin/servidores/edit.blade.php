@props(['servidor', 'cargos'])

<!-- Button trigger modal -->
<button type="button" class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#servidor-{{ $servidor->id }}">
    Editar
</button>

<!-- Modal -->
<div class="modal fade" id="servidor-{{ $servidor->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ $servidor->usuario->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('servidores.update', $servidor->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="name">Nome do servidor *</label>
                                <input class="form-control" type="text" id="name" name="name" required value="{{ $servidor->usuario->name }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="email">E-mail do servidor *</label>
                                <input class="form-control" type="email" id="email" name="email" required value="{{ $servidor->usuario->email }}" disabled/>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="cpf">CPF do Servidor *</label>
                                <input class="form-control" type="text" id="cpf" name="cpf" required value="{{ $servidor->usuario->CPF }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="cargo_id">Cargo *</label>
                                <select name="cargo_id" class="form-select" required>
                                    <option disabled>Selecione o cargo</option>
                                    @foreach($cargos as $cargo)
                                        <option value="{{ $cargo->id }}" {{ $servidor->cargo_id == $cargo->id ? 'selected' : '' }}>
                                            {{ $cargo->descricao }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="password">Senha (deixe em branco para não alterar)</label>
                                <input class="form-control" type="password" id="password" name="password" />
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="btn-group w-100">
                            <button type="submit" class="btn btn-success w-50">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
