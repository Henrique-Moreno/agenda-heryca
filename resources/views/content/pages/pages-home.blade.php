@extends('layouts.layoutMaster')

@section('title', 'Home')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Lista de Psicólogos</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Cargo</th>
                            <th>Escolher</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($servidores as $servidor)
                            <tr>
                                <td>{{ $servidor->usuario->name }}</td>
                                <td>{{ $servidor->usuario->email }}</td>
                                <td>{{ $servidor->cargo->descricao }}</td>
                                <td>
                                <form action="{{url('ver-horarios')}}" method="GET">
                                  <input type="hidden" name="servidor_id" value="{{ $servidor->id }}">
                                  <button type="submit" class="btn btn-primary">Escolher</button>
                                </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
