@extends('layouts.layoutMaster')

@section('title', 'Cadastrar Servidores')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row d-flex justify-content-end">
                <div class="col-md-3">
                    <x-admin.servidores.create :cargos="$cargos" />
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>CPF</th>
                            <th>Cargo</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($servidores as $servidor)
                            <tr>
                                <td>{{ $servidor->usuario->name }}</td>
                                <td>{{ $servidor->usuario->email }}</td>
                                <td>{{ $servidor->usuario->CPF }}</td>
                                <td>{{ $servidor->cargo->descricao }}</td>
                                <td>
                                    <x-admin.servidores.edit :servidor="$servidor" :cargos="$cargos" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
