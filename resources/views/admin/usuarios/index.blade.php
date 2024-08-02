@extends('layouts.layoutMaster')

@section('title', 'Usuarios')

@section('content')
    <div class="card">
        <div class="card-header ">
            <div class="row">
                <div class="col-md-10">
                    <h5>Listando usuários cadastrados</h5>
                </div>
                <div class="col-md-2">
                    <x-admin.usuarios.create :tipos="$tipos"/>
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
                            <th>Tipo de Acesso</th>
                            <th>Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->acesso->descricao }}</td>
                                <td>
                                    <x-admin.usuarios.edit :usuario="$usuario" :tipos="$tipos"/>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
