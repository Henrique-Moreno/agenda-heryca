@extends('layouts.layoutMaster')

@section('title', 'Prontuário')

@section('content')
    <h1>Editar Prontuário</h1>

    <form action="#" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="id_servidor">ID Servidor</label>
            <input type="text" class="form-control" id="id_servidor" name="id_servidor" value="1" required>
        </div>
        <div class="form-group">
            <label for="id_aluno">ID Aluno</label>
            <input type="text" class="form-control" id="id_aluno" name="id_aluno" value="123" required>
        </div>
        <div class="form-group">
            <label for="observacao">Observação</label>
            <textarea class="form-control" id="observacao" name="observacao" required>Observação precisa muito de terapia</textarea>
        </div>
        <div class="form-group">
            <label for="terapia">Terapia</label>
            <input type="text" class="form-control" id="terapia" name="terapia" value="Terapia" required>
        </div>
        <div class="form-group">
            <label for="medicacao">Medicação</label>
            <input type="text" class="form-control" id="medicacao" name="medicacao" value="Medicação muita medicação" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Atualizar</button>
    </form>
@endsection
