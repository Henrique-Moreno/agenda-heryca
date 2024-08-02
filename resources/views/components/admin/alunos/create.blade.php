<!-- Button trigger modal -->
<button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Novo
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastrar novo aluno</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('alunos.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="nome">Nome do aluno *</label>
                                <input class="form-control" type="text" id="nome" name="nome" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="email">E-mail do aluno *</label>
                                <input class="form-control" type="email" id="email" name="email" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="cpf">CPF do aluno *</label>
                                <input class="form-control" type="text" id="cpf" name="cpf" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="curso_id">Curso *</label>
                                <select name="curso_id" class="form-select" required>
                                    <option disabled selected>Selecione o curso</option>
                                    @foreach($cursos as $curso)
                                        <option value="{{ $curso->id }}">{{ $curso->descricao }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="codigo_matricula">Matrícula *</label>
                                    <input class="form-control" type="text" id="codigo_matricula" name="codigo_matricula" required/>
                                </div>
                                <div class="col-md-6">
                                    <label for="codigo_turma">Turma *</label>
                                    <input class="form-control" type="text" id="codigo_turma" name="codigo_turma" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button class="btn btn-success w-100" type="submit">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>