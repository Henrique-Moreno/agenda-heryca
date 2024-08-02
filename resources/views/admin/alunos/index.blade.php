@extends('layouts.layoutMaster')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row d-flex justify-content-end">
                <div class="col-md-3">
                    <x-admin.alunos.create :cursos="$cursos" />
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Curso</th>
                            <th>Turma</th>
                            <th>Matrícula</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($alunos as $aluno)
                            <tr>
                                <td>{{ $aluno->usuario->name }}</td>
                                <td>{{ $aluno->usuario->email }}</td>
                                <td>{{ $aluno->curso->descricao }}</td>
                                <td>{{ $aluno->codigo_turma }}</td>
                                <td>{{ $aluno->codigo_matricula }}</td>
                                <td>
                                    <x-admin.alunos.edit :cursos="$cursos" :aluno="$aluno" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection