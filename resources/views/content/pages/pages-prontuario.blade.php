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
            <label for="nome_aluno">Nome do Aluno</label>
            <input type="text" class="form-control" id="nome_aluno" name="nome_aluno" required>
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
