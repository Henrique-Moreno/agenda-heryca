@extends('layouts.layoutMaster')

@section('title', 'Prontuários')

@section('content')
    <h1>Prontuários</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Formulário de busca -->
    <form method="GET" action="{{ route('prontuario.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Buscar" value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <!-- Botão para criar novo prontuário -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createProntuarioModal">
        Criar Novo Prontuário
    </button>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome do Aluno</th>
                <th>Observação</th>
                <th>Terapia</th>
                <th>Medicação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prontuarios as $prontuario)
                <tr>
                    <td>{{ $prontuario['nome_aluno'] }}</td>
                    <td>{{ $prontuario['observacao'] }}</td>
                    <td>{{ $prontuario['terapia'] }}</td>
                    <td>{{ $prontuario['medicacao'] }}</td>
                    <td>
                        <!-- Botão Editar -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProntuarioModal-{{ $prontuario['id'] }}">
                            Editar
                        </button>

                        <!-- Botão Excluir -->
                        <form action="{{ route('prontuario.destroy', ['id' => $prontuario['id']]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">
                                Excluir
                            </button>
                        </form>

                        <!-- Modal Editar -->
                        <div class="modal fade" id="editProntuarioModal-{{ $prontuario['id'] }}" tabindex="-1" aria-labelledby="editProntuarioModalLabel-{{ $prontuario['id'] }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editProntuarioModalLabel-{{ $prontuario['id'] }}">Editar Prontuário</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('prontuario.update', ['id' => $prontuario['id']]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="nome_aluno" class="form-label">Nome do Aluno</label>
                                                <input type="text" class="form-control" id="nome_aluno" name="nome_aluno" value="{{ $prontuario['nome_aluno'] }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="observacao" class="form-label">Observação</label>
                                                <input type="text" class="form-control" id="observacao" name="observacao" value="{{ $prontuario['observacao'] }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="terapia" class="form-label">Terapia</label>
                                                <input type="text" class="form-control" id="terapia" name="terapia" value="{{ $prontuario['terapia'] }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="medicacao" class="form-label">Medicação</label>
                                                <input type="text" class="form-control" id="medicacao" name="medicacao" value="{{ $prontuario['medicacao'] }}" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

   <!-- Modal Criar -->
   <div class="modal fade" id="createProntuarioModal" tabindex="-1" aria-labelledby="createProntuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createProntuarioModalLabel">Criar Novo Prontuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('prontuario.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nome_aluno" class="form-label">Nome do Aluno</label>
                            <input type="text" class="form-control" id="nome_aluno" name="nome_aluno" required>
                        </div>
                        <div class="mb-3">
                            <label for="observacao" class="form-label">Observação</label>
                            <input type="text" class="form-control" id="observacao" name="observacao" required>
                        </div>
                        <div class="mb-3">
                            <label for="terapia" class="form-label">Terapia</label>
                            <input type="text" class="form-control" id="terapia" name="terapia" required>
                        </div>
                        <div class="mb-3">
                            <label for="medicacao" class="form-label">Medicação</label>
                            <input type="text" class="form-control" id="medicacao" name="medicacao" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
