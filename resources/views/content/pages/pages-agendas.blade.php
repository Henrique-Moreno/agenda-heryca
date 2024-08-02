@extends('layouts.layoutMaster')

@section('title', 'Agenda')

@section('content')
    <h1>Agendas</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Servidor</th>
                <th>ID Aluno</th>
                <th>Data</th>
                <th>Horário</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($agendas as $agenda)
                <tr>
                    <td>{{ $agenda->id }}</td>
                    <td>{{ $agenda->id_servidor }}</td>
                    <td>{{ $agenda->id_aluno }}</td>
                    <td>{{ $agenda->data }}</td>
                    <td>{{ $agenda->horario }}</td>
                    <td>{{ $agenda->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection


