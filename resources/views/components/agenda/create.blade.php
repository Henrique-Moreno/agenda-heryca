@extends('layouts.app')

@section('content')
    <h1>Criar Nova Agenda</h1>

    <form action="{{ route('agendas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_servidor">Servidor</label>
            <select class="form-control" id="id_servidor" name="id_servidor" required>
                @foreach ($servidores as $servidor)
                    <option value="{{ $servidor->id }}">{{ $servidor->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id_aluno">Aluno</label>
            <select class="form-control" id="id_aluno" name="id_aluno" required>
                @foreach ($alunos as $aluno)
                    <option value="{{ $aluno->id }}">{{ $aluno->nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="data">Data</label>
            <input type="date" class="form-control" id="data" name="data" required>
        </div>
        <div class="form-group">
            <label for="horario">Horário</label>
            <input type="text" class="form-control" id="horario" name="horario" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" class="form-control" id="status" name="status" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Criar</button>
    </form>
@endsection
