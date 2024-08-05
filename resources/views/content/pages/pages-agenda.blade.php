@extends('layouts.layoutMaster')

@section('title', 'Agenda')

@section('content')
    <h1>Agenda</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Servidor</th>
                <th>Nome do Servidor</th>
                <th>Email do Servidor</th>
                <th>Data</th>
                <th>Horário</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($agendas as $agenda)
                <tr>
                    <td>{{ $agenda->servidor->id }}</td>
                    <td>{{ $agenda->servidor->usuario->name }}</td>
                    <td>{{ $agenda->servidor->usuario->email }}</td>
                    <td>{{ $agenda->data }}</td>
                    <td>{{ $agenda->horario }}</td>
                    <td>{{ $agenda->status }}</td>
                    <td>
                        <form action="{{ route('agenda.cancel', $agenda->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Cancelar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
