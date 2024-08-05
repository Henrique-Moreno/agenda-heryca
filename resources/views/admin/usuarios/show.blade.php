<!-- resources/views/admin/usuarios/show.blade.php -->

@extends('layouts.layoutMaster')

@section('title', 'Usuarios')

@section('content')
    <div class="container">
        <h1>Detalhes do Usuário</h1>
        <div class="card">
            <div class="card-header">
                {{ $usuario->name }}
            </div>
            <div class="card-body">
                <p><strong>Nome Completo:</strong> {{ $usuario->nome_completo }}</p>
                <p><strong>CPF:</strong> {{ $usuario->CPF }}</p>
                <p><strong>Email:</strong> {{ $usuario->email }}</p>
                <p><strong>Tipo de Acesso:</strong> {{ $usuario->acesso->descricao }}</p>
            </div>
        </div>
    </div>
@endsection

