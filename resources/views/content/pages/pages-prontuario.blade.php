@extends('layouts.layoutMaster')

@section('title', 'Prontuário')

@section('content')
    <h1>Prontuários</h1>

    <!-- Formulário de Busca -->
    <form action="{{ route('prontuario.index') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="search" placeholder="Buscar por nome" value="{{ request()->input('search') }}">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <!-- Mensagens de Status -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Formulário de Cadastro de Prontuário -->
    <h2>Cadastrar Prontuário</h2>
    <form action="{{ route('prontuario.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_servidor">Servidor</label>
            <select class="form-select" id="id_servidor" name="id_servidor" required>
                <option value="">Selecione o Servidor</option>
                @foreach($servidores as $servidor)
                    <option value="{{ $servidor->id }}">{{ $servidor->nome_completo }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id_aluno">Aluno</label>
            <select class="form-select" id="id_aluno" name="id_aluno" required>
                <option value="">Selecione o Aluno</option>
                @foreach($alunos as $aluno)
                    <option value="{{ $aluno->id }}">{{ $aluno->nome_aluno }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="observacao">Observação</label>
            <textarea class="form-control" id="observacao" name="observacao" required></textarea>
        </div>
        <div class="form-group">
            <label for="terapia">Terapia</label>
            <input type="text" class="form-control" id="terapia" name="terapia" required>
        </div>
        <div class="form-group">
            <label for="medicacao">Medicação</label>
            <input type="text" class="form-control" id="medicacao" name="medicacao" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Cadastrar Prontuário</button>
    </form>

    <!-- Lista de Prontuários -->
    <h2>Lista de Prontuários</h2>
    @if($prontuarios->isEmpty())
        <div class="alert alert-warning">
            Nenhum prontuário encontrado.
        </div>
    @else
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Servidor</th>
                    <th>Aluno</th>
                    <th>Observação</th>
                    <th>Terapia</th>
                    <th>Medicação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prontuarios as $prontuario)
                    <tr>
                        <td>{{ $prontuario->servidor->nome_completo }}</td>
                        <td>{{ $prontuario->aluno->nome_aluno }}</td>
                        <td>{{ $prontuario->observacao }}</td>
                        <td>{{ $prontuario->terapia }}</td>
                        <td>{{ $prontuario->medicacao }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
