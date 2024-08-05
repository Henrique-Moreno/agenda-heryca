@extends('layouts.layoutMaster')

@section('title', 'Agenda')

@section('content')
    <h1>Agenda</h1>

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

    <!-- Botão para criar nova agenda -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createAgendaModal">
        Criar Nova Agenda
    </button>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Horário</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($agendas as $agenda)
                <tr>
                    <td>{{ $agenda['nome'] }}</td>
                    <td>{{ $agenda['horario'] }}</td>
                    <td>{{ $agenda['status'] }}</td>
                    <td>
                        <!-- Botão Editar -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editAgendaModal-{{ $agenda['id'] }}">
                            Editar
                        </button>

                        <!-- Botão Excluir -->
                        <form action="{{ route('agenda.destroy', $agenda['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">
                                Excluir
                            </button>
                        </form>

                        <!-- Modal Editar -->
                        <div class="modal fade" id="editAgendaModal-{{ $agenda['id'] }}" tabindex="-1" aria-labelledby="editAgendaModalLabel-{{ $agenda['id'] }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editAgendaModalLabel-{{ $agenda['id'] }}">Editar Agenda</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('agenda.update', $agenda['id']) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="nome" class="form-label">Nome</label>
                                                <input type="text" class="form-control" id="nome" name="nome" value="{{ $agenda['nome'] }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="horario" class="form-label">Horário</label>
                                                <input type="time" class="form-control" id="horario" name="horario" value="{{ $agenda['horario'] }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" id="status" name="status" required>
                                                    <option value="confirmado" {{ $agenda['status'] == 'confirmado' ? 'selected' : '' }}>Confirmado</option>
                                                    <option value="pendente" {{ $agenda['status'] == 'pendente' ? 'selected' : '' }}>Pendente</option>
                                                    <option value="cancelado" {{ $agenda['status'] == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                                                </select>
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
    <div class="modal fade" id="createAgendaModal" tabindex="-1" aria-labelledby="createAgendaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createAgendaModalLabel">Criar Nova Agenda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('agenda.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="horario" class="form-label">Horário</label>
                            <input type="time" class="form-control" id="horario" name="horario" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="confirmado">Confirmado</option>
                                <option value="pendente">Pendente</option>
                                <option value="cancelado">Cancelado</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
