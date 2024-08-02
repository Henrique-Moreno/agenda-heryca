<!-- Button trigger modal -->
<button type="button" class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#aluno-{{ $aluno->id }}">
    Editar
</button>

<!-- Modal -->
<div class="modal fade" id="aluno-{{ $aluno->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">{{ $aluno->usuario->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('alunos.update', $aluno->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="nome">Nome do aluno *</label>
                                <input class="form-control" type="text" id="nome" name="nome" required value="{{ $aluno->usuario->name }}" />
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="email">E-mail do aluno *</label>
                                <input class="form-control" type="email" id="email" name="email" required value="{{ $aluno->usuario->email }}" disabled/>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="form-group">
                            <div class="col-md-12">
                                <label for="cpf">CPF do aluno *</label>
                                <input class="form-control" type="text" id="cpf" name="cpf" required value="{{ $aluno->usuario->CPF }}"/>
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
                                        @if($aluno->curso_id == $curso->id)
                                            <option value="{{ $curso->id }}" selected>{{ $curso->descricao }}</option>
                                        @else
                                            <option value="{{ $curso->id }}">{{ $curso->descricao }}</option>
                                        @endif
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
                                    <input class="form-control" type="text" id="codigo_matricula" name="codigo_matricula" required value="{{ $aluno->codigo_matricula }}"/>
                                </div>
                                <div class="col-md-6">
                                    <label for="codigo_turma">Turma *</label>
                                    <input class="form-control" type="text" id="codigo_turma" name="codigo_turma" required value="{{ $aluno->codigo_turma }}"/>
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