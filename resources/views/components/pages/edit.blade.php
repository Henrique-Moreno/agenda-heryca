<!-- resources/views/content/pages/edit.blade.php -->
@extends('layouts.layoutMaster')

@section('title', 'Editar Agenda')

@section('content')
    <h1>Editar Agenda</h1>

    <form action="{{ route('agenda.update', $agenda['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $agenda['nome'] }}" required>
        </div>
        <div class="form-group">
            <label for="data">Data</label>
            <input type="text" class="form-control" id="data" name="data" value="{{ $agenda['data'] }}" required>
        </div>
        <div class="form-group">
            <label for="horario">Horário</label>
            <input type="text" class="form-control" id="horario" name="horario" value="{{ $agenda['horario'] }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <input type="text" class="form-control" id="status" name="status" value="{{ $agenda['status'] }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
@endsection
